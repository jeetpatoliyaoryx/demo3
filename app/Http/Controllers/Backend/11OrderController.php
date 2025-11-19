<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OrdersModel;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Exception;

class OrderController extends Controller
{
    protected string $base;
    protected string $email;
    protected string $password;

    public function __construct()
    {
        $this->base = config('services.shiprocket.base');
        $this->email = config('services.shiprocket.email');
        $this->password = config('services.shiprocket.password');
    }

    //  Token Handling
    protected function getToken(): string
    {
        $cached = Cache::get('shiprocket_token');
        if ($cached) return $cached;

        $res = Http::asJson()->post($this->base . '/auth/login', [
            'email' => $this->email,
            'password' => $this->password,
        ]);
dd($res);
        if (! $res->ok()) {
            throw new Exception('Shiprocket auth failed: ' . $res->body());
        }

        $data = $res->json();
        $token = $data['token'] ?? $data['data']['token'] ?? null;

        if (! $token) {
            throw new Exception('Shiprocket auth returned no token: ' . json_encode($data));
        }

        Cache::put('shiprocket_token', $token, now()->addHours(240));
        return $token;
    }

    protected function withAuth()
    {
        dd($this->getToken());
        return Http::withToken($this->getToken())->acceptJson();
    }

    //  Create order in Shiprocket
    public function shipToShiprocket($id)
    {
        $order = OrdersModel::findOrFail($id);

        $payload = [
            'order_id' => (string) $order->id,
            'order_date' => $order->created_at ? $order->created_at->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s'),
            'pickup_location' => 'Default',
            'billing_customer_name' => trim($order->first_name . ' ' . $order->last_name),
            'billing_address' => $order->street_address . ' ' . $order->flat_other,
            'billing_city' => $order->city,
            'billing_pincode' => $order->pin_code,
            'billing_state' => $order->state,
            'billing_country' => 'India',
            'billing_email' => $order->email,
            'billing_phone' => $order->phone_number,
            'shipping_is_billing' => true,
            'payment_method' => ($order->is_payment == 0) ? 'COD' : 'Prepaid',
            'sub_total' => (float) $order->total,
            'length' => 10, 'breadth' => 10, 'height' => 5, 'weight' => 0.5,
            'order_items' => [
                [
                    'name' => 'Order #' . $order->id,
                    'sku' => 'ORD-'.$order->id,
                    'units' => (int)$order->total_qty ?: 1,
                    'selling_price' => (float)$order->total,
                    'discount' => 0,
                    'tax' => 0,
                    'product_weight' => 0.5,
                ]
            ]
        ];

        try {
            $res = $this->withAuth()
                        ->post($this->base . '/orders/create/adhoc', $payload)
                        ->json();

            $shiprocketOrderId = $res['order_id'] ?? $res['data']['order_id'] ?? null;
            $shipmentId = $res['shipment_id'] ?? $res['data']['shipment_id'] ?? null;

            Shipment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'shiprocket_order_id' => $shiprocketOrderId,
                    'shiprocket_shipment_id' => $shipmentId,
                    'raw_response' => json_encode($res),
                ]
            );

            return back()->with('success', 'Created Shiprocket order. Shipment ID: ' . $shipmentId);
        } catch (\Exception $e) {
            return back()->with('error', 'Shiprocket create failed: ' . $e->getMessage());
        }
    }
}
