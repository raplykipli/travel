<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhapiService
{
    protected $token;
    protected $baseUrl;

    public function __construct()
    {
        $this->token = config('services.whapi.token');
        $this->baseUrl = config('services.whapi.base_url');
    }

    /**
     * Send a WhatsApp message via Whapi
     *
     * @param string $to Phone number with country code (e.g., 628123456789)
     * @param string $message The message body
     * @return array|bool Returns response data on success, false on failure
     */
    public function sendMessage($to, $message)
    {
        if (empty($this->token)) {
            Log::warning('Whapi API token is not configured. Message not sent.');
            return false;
        }

        // Format phone number: only keep digits (strip any non-numeric chars)
        $to = preg_replace('/[^0-9]/', '', $to);

        try {
            // Local Whapi uses /sendMessage endpoint with 'apiKey' & 'phone' & 'message' fields
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}sendMessage", [
                'apiKey'  => $this->token,
                'phone'   => $to,
                'message' => $message,
            ]);

            if ($response->successful()) {
                Log::info("WhatsApp message sent successfully to {$to}");
                return $response->json();
            }

            Log::error("Failed to send WhatsApp message. Status: {$response->status()}, Response: {$response->body()}");
            return false;

        } catch (\Exception $e) {
            Log::error("Exception when sending WhatsApp message: " . $e->getMessage());
            return false;
        }
    }
}
