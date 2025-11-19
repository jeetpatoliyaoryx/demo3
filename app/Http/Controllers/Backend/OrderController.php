<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OrdersModel;
use App\Services\ShiprocketService;
use App\Models\Shipment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $ship;

    public function __construct(ShiprocketService $ship)
    {

        $this->ship = $ship;
       // dd($this->ship);
    }

    // existing list() stays the same
    // create Shiprocket order (adhoc) for a given order id
    public function shipToShiprocket($id)
    {


        $order = OrdersModel::findOrFail($id);

        // build payload per Shiprocket create/adhoc API.
        // map your DB fields to the expected structure. This is a common minimal payload:
        // $payload = [
        //     'order_id' => (string) $order->id, // your own id
        //     'order_date' => $order->created_at ? $order->created_at->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s'),
        //     'pickup_location' => 'Default', // should match a pickup location you have in SR account
        //     'billing_customer_name' => trim($order->first_name . ' ' . $order->last_name),
        //     'billing_address' => $order->street_address . ' ' . $order->flat_other,
        //     'billing_city' => $order->city,
        //     'billing_pincode' => $order->pin_code,
        //     'billing_state' => $order->state,
        //     'billing_country' => 'India',
        //     'billing_email' => $order->email,
        //     'billing_phone' => $order->phone_number,
        //     'shipping_is_billing' => true,
        //     'payment_method' => ($order->is_payment == 0) ? 'COD' : 'Prepaid',
        //     'sub_total' => (float) $order->total,
        //     'length' => 10, 'breadth' => 10, 'height' => 5, 'weight' => 0.5,
        //     // order_items: at least one item. Adjust according to your products table.
        //     'order_items' => [
        //         [
        //             'name' => 'Order #' . $order->id,
        //             'sku' => 'ORD-'.$order->id,
        //             'units' => (int)$order->total_qty ?: 1,
        //             'selling_price' => (float)$order->total,
        //             'discount' => 0,
        //             'tax' => 0,
        //             'product_weight' => 0.5,
        //         ]
        //     ]
        // ];
       
  $payload = [
    "order_id" => "12345",
    "order_date" => "2025-09-12 10:10:27",
    "pickup_location" => "work",
    "billing_customer_name" => "Test User",
    "billing_last_name" => "shree",
    "billing_address" => "123 Street",
    "billing_city" => "Delhi",
    "billing_pincode" => "110001",
    "billing_state" => "Delhi",
    "billing_country" => "India",
    "billing_email" => "test@example.com",
    "billing_phone" => "9941599815",
    "shipping_is_billing" => true,
    "payment_method" => "COD",
    "sub_total" => 100.0,
    "length" => 10,
    "breadth" => 10,
    "height" => 5,
    "weight" => 0.5,
    "order_items" => [
        [
            "name" => "Test Product",
            "sku" => "TEST123",
            "units" => 1,
            "selling_price" => 100.0,
            "discount" => 0,
            "tax" => 0,
            "product_weight" => 0.5
        ]
    ]
];




        try {
            $res = $this->ship->createOrder($payload);

            // Shiprocket returns order_id and shipment_id in response (check response structure)
            $shiprocketOrderId = $res['order_id'] ?? $res['data']['order_id'] ?? null;
            $shipmentId = $res['shipment_id'] ?? $res['data']['shipment_id'] ?? null;

            $shipment = Shipment::updateOrCreate(
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

    // assign AWB for a stored shipment (by order id)
    public function assignAwb($id)
    {
        $shipment = Shipment::where('order_id', $id)->firstOrFail();
        if (! $shipment->shiprocket_shipment_id) {
            return back()->with('error', 'No shiprocket_shipment_id found; create order first.');
        }

        $res = $this->ship->assignAwb((int)$shipment->shiprocket_shipment_id);

        // parse response for awb
        $awb = $res['awb_code'] ?? $res['data']['awb_code'] ?? ($res['response']['awb_code'] ?? null);
        $courier = $res['courier_name'] ?? $res['data']['courier_name'] ?? null;

        $shipment->update([
            'awb_code' => $awb,
            'courier_name' => $courier,
            'raw_response' => json_encode($res),
        ]);

        return back()->with('success', 'AWB assigned: ' . $awb);
    }

    // generate label (returns PDF URL)
    public function generateLabel($id)
    {
        $shipment = Shipment::where('order_id', $id)->firstOrFail();
        if (! $shipment->shiprocket_shipment_id) {
            return back()->with('error', 'No shiprocket_shipment_id found.');
        }

        $res = $this->ship->generateLabel([(int)$shipment->shiprocket_shipment_id]);

        // API returns a label URL (check response structure)
        $labelUrl = $res['label_url'] ?? $res['data']['label_url'] ?? $res['response']['label_url'] ?? null;

        if ($labelUrl) {
            $shipment->update(['label_url' => $labelUrl, 'raw_response' => json_encode($res)]);
            return redirect($labelUrl); // download / open label PDF
        }

        return back()->with('error', 'Label generation failed: ' . json_encode($res));
    }

    // track by AWB
    public function track($id)
    {
        $shipment = Shipment::where('order_id', $id)->first();
        if (! $shipment || ! $shipment->awb_code) {
            return back()->with('error', 'AWB not present. Assign AWB first.');
        }

        $res = $this->ship->trackAwb($shipment->awb_code);

        // show admin a small view or JSON
        return view('backend.orders.track', ['track' => $res, 'shipment' => $shipment]);
    }
}



