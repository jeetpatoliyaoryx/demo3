<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class ShiprocketWebhookController extends Controller
{
    public function handle(Request $request)
    {
     
        // optional secret verification (Shiprocket allows you to configure a token)
        $secret = config('shiprocket.webhook_secret');
        if ($secret) {
            $tokenHeader = $request->header('x-shiprocket-token') ?? $request->header('shiprocket-token') ?? $request->header('x-webhook-token');
            if (! hash_equals($secret, (string) $tokenHeader)) {
                Log::warning('Shiprocket webhook secret mismatch.', ['headers' => $request->headers->all()]);
                return response()->json(['status' => 'unauthorized'], 401);
            }
        }

        $payload = $request->all();
        Log::info('Shiprocket webhook received', $payload);

        // Example: webhook contains awb and tracking status - find order and update
        $awb = data_get($payload, 'awb') ?? data_get($payload, 'data.awb') ?? data_get($payload, 'shipment.awb');
        $status = data_get($payload, 'status') ?? data_get($payload, 'data.status');
        if ($awb) {
            $order = Order::where('shiprocket_awb', $awb)->first();
            if ($order) {
                $order->update(['shipping_status' => $status]);
            }
        }

        return response()->json(['received' => true]);
    }
}
