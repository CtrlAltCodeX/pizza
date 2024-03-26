<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CloverService
{
    protected $baseUrl;
    protected $accessToken;
    protected $merchantId;

    public function __construct()
    {
        $this->baseUrl = config('services.clover.base_url');
        $this->accessToken = config('services.clover.access_token');
        $this->merchantId = config('services.clover.merchant_id');
    }

    public function processPayment($amount, $orderId)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Accept' => 'application/json',
        ])->post($this->baseUrl . "/v3/merchants/{$this->merchantId}/pay", [
            'amount' => $amount, // Payment amount in cents
            'orderId' => $orderId, // Unique identifier for the order
        ]);

        return $response->json();
    }
}
