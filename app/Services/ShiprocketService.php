<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Exception;

class ShiprocketService
{
    protected string $base;
    protected string $email;
    protected string $password;

    public function __construct()
    {
        // Example: config('services.shiprocket.base') => 'https://apiv2.shiprocket.in/v1/external'
        $this->base = rtrim(config('services.shiprocket.base'), '/');
        $this->email = config('services.shiprocket.email');
        $this->password = config('services.shiprocket.password');
    }

    /**
     * Fetch token from cache or API.
     * Shiprocket tokens are long lived (~240 hours) so we cache them.
     * (Docs: token validity ≈ 10 days). :contentReference[oaicite:1]{index=1}
     */
    // public function getToken(): string
    // {
    //     return Cache::remember('shiprocket.token', now()->addHours(240), function () {
    //         $res = Http::asJson()->post($this->base . '/auth/login', [
    //             'email' => $this->email,
    //             'password' => $this->password,
    //         ]);

    //         if (!$res->successful()) {
    //             Log::error('Shiprocket auth failed', ['status' => $res->status(), 'body' => $res->body()]);
    //             throw new Exception('Shiprocket auth failed: ' . $res->body());
    //         }

    //         $json = $res->json();
    //         // shiprocket sometimes returns token directly or inside data.token
    //         $token = $json['token'] ?? $json['data']['token'] ?? null;

    //         if (!$token) {
    //             Log::error('Shiprocket auth returned no token', ['response' => $json]);
    //             throw new Exception('Shiprocket auth returned no token: ' . json_encode($json));
    //         }

    //         return $token;
    //     });
    // }

    public function getToken(): string
    {
      
        $res = Http::asJson()->post($this->base . '/auth/login', [
            'email' => $this->email,
            'password' => $this->password,
        ]);


        if (!$res->ok()) {
            throw new Exception('Shiprocket auth failed: ' . $res->body());
        }

        $data = $res->json();
        $token = $data['token'] ?? $data['data']['token'] ?? null;

        if (!$token) {
            throw new Exception('Shiprocket auth returned no token: ' . json_encode($data));
        }

        return $token;
    }

    /**
     * Http client with bearer token
     */
    protected function withAuth()
    {
        return Http::withToken($this->getToken())
                    ->acceptJson()
                    ->contentType('application/json');
    }

    /* -------------------- Core API wrappers -------------------- */

    public function createOrderAdhoc(array $payload): array
    {
        $res = $this->withAuth()->post($this->base . '/orders/create/adhoc', $payload);

        if (!$res->successful()) {
            Log::error('Shiprocket create order failed', ['status' => $res->status(), 'body' => $res->body()]);
            throw new Exception('Create order failed: ' . $res->body());
        }

        return $res->json();
    }

    public function getOrder(string|int $orderId): array
    {
        $res = $this->withAuth()->get($this->base . "/orders/show/{$orderId}");

        if (!$res->successful()) {
            throw new Exception('Get order failed: ' . $res->body());
        }

        return $res->json();
    }

    public function checkServiceability(array $params): array
    {
        // Serviceability docs: GET endpoint /courier/serviceability/ (we pass query)
        $res = $this->withAuth()->get($this->base . '/courier/serviceability', $params);

        if (!$res->successful()) {
            throw new Exception('Serviceability failed: ' . $res->body());
        }

        return $res->json();
    }

    public function assignAwb(int $shipmentId, ?int $courierId = null): array
    {
        $payload = ['shipment_id' => $shipmentId];
        if ($courierId) $payload['courier_id'] = $courierId;

        $res = $this->withAuth()->post($this->base . '/courier/assign/awb', $payload);

        if (!$res->successful()) {
            throw new Exception('Assign AWB failed: ' . $res->body());
        }

        return $res->json();
    }

    public function generateLabel(array $shipmentIds): array
    {
        // Shiprocket expects shipment_id as array
        $res = $this->withAuth()->post($this->base . '/courier/generate/label', [
            'shipment_id' => $shipmentIds
        ]);

        if (!$res->successful()) {
            throw new Exception('Generate label failed: ' . $res->body());
        }

        return $res->json();
    }

    public function generatePickup(array $payload): array
    {
        // POST /courier/generate/pickup
        $res = $this->withAuth()->post($this->base . '/courier/generate/pickup', $payload);

        if (!$res->successful()) {
            throw new Exception('Generate pickup failed: ' . $res->body());
        }

        return $res->json();
    }

    public function printInvoice(array $orderIds): array
    {
        // /orders/print/invoice - usually returns PDF url or file link
        $res = $this->withAuth()->post($this->base . '/orders/print/invoice', [
            'order_id' => $orderIds // some docs accept an array or single id; adapt if needed
        ]);

        if (!$res->successful()) {
            throw new Exception('Print invoice failed: ' . $res->body());
        }

        return $res->json();
    }

    public function generateManifest(array $payload): array
    {
        // POST /manifests/generate
        $res = $this->withAuth()->post($this->base . '/manifests/generate', $payload);

        if (!$res->successful()) {
            throw new Exception('Generate manifest failed: ' . $res->body());
        }

        return $res->json();
    }

    public function trackByAwb(string $awb): array
    {
        $res = $this->withAuth()->get($this->base . "/courier/track/awb/{$awb}");

        if (!$res->successful()) {
            throw new Exception('Track failed: ' . $res->body());
        }

        return $res->json();
    }
}
