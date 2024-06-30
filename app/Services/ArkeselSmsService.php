<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ArkeselSmsService
{
    public function sendSms($sender, $message, $recipients, $baseUrl, $apiKey)
    {
        $response = Http::withHeaders([
            'api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post($baseUrl, [
            'sender' => $sender,
            'message' => $message,
            'recipients' => $recipients,
        ]);

        if ($response->successful()) {
            $responseData = $response->json();

            // Log the successful response
            Log::info('SMS sent successfully', $responseData);

            return [
                'status' => $responseData['status'],
                'data' => $responseData['data'],
            ];
        } else {
            // Log the failed response
            Log::error('Failed to send SMS', $response->json());

            return [
                'status' => 'error',
                'data' => $response->json(),
            ];
        }
    }
}
