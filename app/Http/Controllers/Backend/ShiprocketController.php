<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OrdersModel;
use App\Models\Shipment;
use App\Services\ShiprocketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ShiprocketController extends Controller
{
    protected ShiprocketService $sr;

    public function __construct(ShiprocketService $shiprocketService)
    {
        $this->sr = $shiprocketService;
    }

    /**
     * Build Shiprocket order payload from your OrdersModel.
     * Adjust fields mapping to match your OrdersModel schema.
     */
    protected function buildOrderPayload(OrdersModel $order): array
    {
        // Map your order model fields to Shiprocket payload fields.
        // Replace these with actual column names in your DB.
        $billingName = $order->billing_name ?? ($order->customer_name ?? 'Customer');
        $billingPhone = $order->billing_phone ?? $order->phone ?? '9941599815';
        $billingEmail = $order->billing_email ?? $order->email ?? 'test@example.com';

        $items = [];
        foreach ($order->items ?? [] as $item) {
            $items[] = [
                "name" => $item['name'] ?? $item->name ?? 'Product',
                "sku" => $item['sku'] ?? $item->sku ?? 'SKU-' . $order->id,
                "units" => (int)($item['qty'] ?? $item->quantity ?? 1),
                "selling_price" => (float)($item['price'] ?? $item->selling_price ?? 0),
                "discount" => 0,
                "tax" => 0,
                "product_weight" => (float)($item['weight'] ?? 0.0)
            ];
        }

        // Minimal required structure for create/adhoc
        return [
            "order_id"              => (string)($order->id),
            "order_date"            => $order->created_at?->format('Y-m-d H:i:s') ?? now()->format('Y-m-d H:i:s'),
            "pickup_location"       => config('services.shiprocket.pickup_location') ?? 'work',
            "billing_customer_name" => explode(' ', $billingName)[0] ?? $billingName,
            "billing_last_name"     => explode(' ', $billingName, 2)[1] ?? '',
            "billing_address"       => $order->billing_address ?? $order->address ?? '123 Street',
            "billing_city"          => $order->billing_city ?? 'City',
            "billing_pincode"       => (string)($order->billing_pincode ?? $order->pincode ?? '110001'),
            "billing_state"         => $order->billing_state ?? 'State',
            "billing_country"       => $order->billing_country ?? 'India',
            "billing_email"         => $billingEmail,
            "billing_phone"         => $billingPhone,
            "shipping_is_billing"   => true,
            "payment_method"        => strtoupper($order->payment_method ?? 'COD'),
            "sub_total"             => (float)($order->sub_total ?? $order->total ?? 0),
            "length"                => (float)($order->length ?? 10),
            "breadth"               => (float)($order->breadth ?? 10),
            "height"                => (float)($order->height ?? 5),
            "weight"                => (float)($order->weight ?? 0.5),
            "order_items"           => $items ?: [[
                "name" => "Default product",
                "sku" => "DEF-{$order->id}",
                "units" => 1,
                "selling_price" => (float)($order->sub_total ?? 0),
                "discount" => 0,
                "tax" => 0,
                "product_weight" => (float)($order->weight ?? 0.5)
            ]]
        ];
    }

    /**
     * Create Shiprocket order
     */
    public function shipToShiprocket($id)
    {

        $order = OrdersModel::findOrFail($id);

        $payload = $this->buildOrderPayload($order);

        try {
            $res = $this->sr->createOrderAdhoc($payload);

            Log::info('Shiprocket create response', ['order' => $order->id, 'response' => $res]);

            // Save response to DB (create/update shipment record)
            $shipment = Shipment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'shiprocket_order_id' => $res['order_id'] ?? $res['data']['order_id'] ?? null,
                    'shiprocket_shipment_id' => $res['shipment_id'] ?? $res['data']['shipment_id'] ?? null,
                    'raw_response' => json_encode($res),
                ]
            );

            return back()->with('success', 'Shiprocket order created. Shipment ID: ' . ($shipment->shiprocket_shipment_id ?? 'N/A'));
        } catch (Exception $e) {
            Log::error('Shiprocket create failed', ['order' => $order->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Shiprocket create failed: ' . $e->getMessage());
        }
    }

    /**
     * Assign AWB
     */
    public function assignAwb($id)
{
    $shipment = Shipment::where('order_id', $id)->firstOrFail();

    if (!$shipment->shiprocket_shipment_id) {
        return back()->with('error', 'No Shiprocket shipment ID found. Create order first.');
    }

    try {
        $res = $this->sr->assignAwb((int)$shipment->shiprocket_shipment_id);

        // Save the raw response always
        $shipment->update([
            'raw_response' => json_encode($res),
        ]);

        // Check if ShipRocket returned an error
        if (isset($res['status_code']) && $res['status_code'] != 200) {
            // Get the message from response.data if available
            $errorMessage = $res['response']['data']['awb_assign_error'] ?? $res['message'] ?? 'AWB assignment failed';
            return back()->with('error', $errorMessage);
        }

        // Update AWB and courier if available
        $shipment->update([
            'awb_code' => $res['awb_code'] ?? $res['response']['data']['awb_code'] ?? null,
            'courier_name' => $res['courier_name'] ?? $res['response']['data']['courier_name'] ?? null,
        ]);

        return back()->with('success', 'AWB assigned: ' . ($shipment->awb_code ?? 'N/A'));

    } catch (Exception $e) {
        Log::error('Assign AWB failed', ['shipment' => $shipment->id, 'error' => $e->getMessage()]);
        return back()->with('error', 'Assign AWB failed: ' . $e->getMessage());
    }
}


    public function assignAwb_olds($id)
    {
        $shipment = Shipment::where('order_id', $id)->firstOrFail();

        if (!$shipment->shiprocket_shipment_id) {
            return back()->with('error', 'No Shiprocket shipment ID found. Create order first.');
        }

       try {
            $res = $this->sr->assignAwb((int)$shipment->shiprocket_shipment_id);

            $shipment->update([
                'awb_code' => $res['awb_code'] ?? $res['data']['awb_code'] ?? null,
                'courier_name' => $res['courier_name'] ?? $res['data']['courier_name'] ?? null,
                'raw_response' => json_encode($res),
            ]);

dd($res);
            return back()->with('success', 'AWB assigned: ' . ($shipment->awb_code ?? 'N/A'));
        } catch (Exception $e) {
            Log::error('Assign AWB failed', ['shipment' => $shipment->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Assign AWB failed: ' . $e->getMessage());
        }
    }

    /**
     * Generate label (will redirect to PDF url if returned)
     */
    public function generateLabel_old($id)
    {
        $shipment = Shipment::where('order_id', $id)->firstOrFail();

        if (!$shipment->shiprocket_shipment_id) {
            return back()->with('error', 'No Shiprocket shipment ID found.');
        }

        try {
            $res = $this->sr->generateLabel([(int)$shipment->shiprocket_shipment_id]);

            // Label URL sometimes in data.label_url or label_url
            $labelUrl = $res['label_url'] ?? $res['data']['label_url'] ?? null;

            $shipment->update(['label_url' => $labelUrl, 'raw_response' => json_encode($res)]);

            if ($labelUrl) {
                return redirect()->away($labelUrl);
            }

            return back()->with('error', 'Label generation failed: ' . json_encode($res));
        } catch (Exception $e) {
            Log::error('Generate label failed', ['shipment' => $shipment->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Generate label failed: ' . $e->getMessage());
        }
    }

    public function generateLabel($id)
{
    $shipment = Shipment::where('order_id', $id)->firstOrFail();

    if (!$shipment->shiprocket_shipment_id) {
        return back()->with('error', 'No Shiprocket shipment ID found.');
    }

    try {
        $res = $this->sr->generateLabel([(int)$shipment->shiprocket_shipment_id]);

        // Save raw response for debugging
        $shipment->update(['raw_response' => json_encode($res)]);

        // Check if label was created
        if (!empty($res['label_created']) && $res['label_created'] == 1) {
            $labelUrl = $res['label_url'] ?? $res['data']['label_url'] ?? null;
            $shipment->update(['label_url' => $labelUrl]);

            if ($labelUrl) {
                return redirect()->away($labelUrl);
            }
        }

        // If label not created, get error message
        $errorMessage = $res['response'] ?? 'Label generation failed';
        if (!empty($res['not_created']) && is_array($res['not_created'])) {
            $errorMessage .= ': ' . implode(', ', $res['not_created']);
        }

        return back()->with('error', $errorMessage);

    } catch (Exception $e) {
        Log::error('Generate label failed', ['shipment' => $shipment->id, 'error' => $e->getMessage()]);
        return back()->with('error', 'Generate label failed: ' . $e->getMessage());
    }
}


    /**
     * Generate pickup for a shipment or list of shipments.
     * Build a payload per your pickup time/location. Example payload structure is from Shiprocket docs.
     */
    public function generatePickup(Request $request, $id)
    {

        // Simple example: pick up all shipments of this order
        $shipment = Shipment::where('order_id', $id)->firstOrFail();

        $payload = [
            "pickup_id" => null,
            "pickup_date" => $request->input('pickup_date', now()->format('Y-m-d')),
            "pickup_time_from" => $request->input('pickup_time_from', '10:00'),
            "pickup_time_to" => $request->input('pickup_time_to', '18:00'),
            "merchant_name" => $request->input('merchant_name', config('app.name')),
            "merchant_address" => $request->input('merchant_address', config('app.name')),
            "merchant_city" => $request->input('merchant_city', 'City'),
            "merchant_pincode" => $request->input('merchant_pincode', '000000'),
            "merchant_state" => $request->input('merchant_state', 'State'),
            "merchant_country" => "India",
            "merchant_email" => $request->input('merchant_email', 'test@example.com'),
            "merchant_phone" => $request->input('merchant_phone', '9941599815'),
            // shipment ids array
            "shipments" => [
                (int)$shipment->shiprocket_shipment_id
            ]
        ];

        try {
            $res = $this->sr->generatePickup($payload);
            $shipment->update(['raw_response' => json_encode($res)]);
            dd($res);

            return back()->with('success', 'Pickup generated: ' . json_encode($res));
        } catch (Exception $e) {
            
          //  Log::error('Generate pickup failed', ['shipment' => $shipment->id, 'error' => $e->getMessage()]);
          //  return back()->with('error', 'Generate pickup failed: ' . $e->getMessage());
              return back()->with('error', 'Generate pickup failed: First Create Assign AWB');
        }
    }

    /**
     * Print invoice (returns PDF url in response according to docs)
     */
    public function printInvoice($id)
    {
        $order = OrdersModel::findOrFail($id);

        try {
            $res = $this->sr->printInvoice([(string)$order->id]); // adapt shape if API expects different key

            // response should contain pdf url (inspect returned JSON)
            return back()->with('success', 'Invoice response: ' . json_encode($res));
        } catch (Exception $e) {
            //Log::error('Print invoice failed', ['order' => $order->id, 'error' => $e->getMessage()]);
            //return back()->with('error', 'Print invoice failed: ' . $e->getMessage());
            return back()->with('error', 'Print invoice failed: First Generate Pickup');
        }
    }

    /**
     * Generate manifest
     */
    public function generateManifest(Request $request)
    {
        // Example: accept list of shipment ids from request
        $shipmentIds = $request->input('shipments', []);
        if (empty($shipmentIds)) {
            return back()->with('error', 'No shipments provided for manifest.');
        }

        try {
            $res = $this->sr->generateManifest([
                'shipments' => $shipmentIds
            ]);

            return back()->with('success', 'Manifest generated: ' . json_encode($res));
        } catch (Exception $e) {
            Log::error('Generate manifest failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Generate manifest failed: ' . $e->getMessage());
        }
    }

    /**
     * Track (existing)
     */
    public function track($id)
    {
        $shipment = Shipment::where('order_id', $id)->first();

        if (!$shipment || !$shipment->awb_code) {
            return back()->with('error', 'AWB not present. Assign AWB first.');
        }

        $res = $this->sr->trackByAwb($shipment->awb_code);
        return view('backend.orders.track', ['track' => $res, 'shipment' => $shipment]);
    }

    public function create_shiprocket_order_all_option(Request $request) {

       if(!empty($request->id))
        {
            $option = explode(',', $request->id);
            foreach($option as $id)
            {
                if(!empty($id))
                {
                    $getrecord = OrdersModel::find($id);
                    $getrecord->shiprocket_status = 1;
                    $getrecord->save();       
                }
            }
        }
      
        return redirect('admin/orders')->with('success', 'Record successfully created');
    }

      public function shipToShiprocketBulk(Request $request)
    {

        $orderIds = $request->input('order_ids', []);

        if (empty($orderIds)) {
            return back()->with('error', 'No orders selected.');
        }

        $created = 0;
        $failed = [];

        foreach ($orderIds as $id) {
            try {
                $order = OrdersModel::findOrFail($id);
               // dd($order);
                $payload = $this->buildOrderPayload($order);

                $res = $this->sr->createOrderAdhoc($payload);

                Log::info('Shiprocket bulk create response', ['order' => $order->id, 'response' => $res]);

                Shipment::updateOrCreate(
                    ['order_id' => $order->id],
                    [
                        'shiprocket_order_id' => $res['order_id'] ?? $res['data']['order_id'] ?? null,
                        'shiprocket_shipment_id' => $res['shipment_id'] ?? $res['data']['shipment_id'] ?? null,
                        'raw_response' => json_encode($res),
                    ]
                );

                $created++;
            } catch (Exception $e) {
                Log::error('Shiprocket bulk create failed', ['order' => $id, 'error' => $e->getMessage()]);
                $failed[] = $id;
            }
        }

        $msg = "{$created} Shiprocket orders created successfully.";
        if (!empty($failed)) {
            $msg .= ' Failed: ' . implode(', ', $failed);
        }

        return back()->with('success', $msg);
    }

}
