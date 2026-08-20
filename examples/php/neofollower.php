<?php

/**
 * Minimal NeoFollower Reseller API client.
 *
 * Run:
 *   NEOFOLLOWER_API_KEY="YOUR_API_KEY" php neofollower.php
 */

final class NeoFollowerApi
{
    private string $endpoint = 'https://panel.neofollower.com/api/v1';
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    private function request(array $payload): array
    {
        $payload['key'] = $this->apiKey;

        $ch = curl_init($this->endpoint);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json',
            ],
        ]);

        $body = curl_exec($ch);

        if ($body === false) {
            throw new RuntimeException(curl_error($ch));
        }

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status < 200 || $status >= 300) {
            throw new RuntimeException("NeoFollower API HTTP error: {$status}");
        }

        $data = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

        return $data;
    }

    public function services(): array
    {
        return $this->request(['action' => 'services']);
    }

    public function addOrder(
        int $service,
        string $link,
        int $quantity,
        array $extra = []
    ): array {
        return $this->request(array_merge([
            'action' => 'add',
            'service' => $service,
            'link' => $link,
            'quantity' => $quantity,
        ], $extra));
    }

    public function status(int $orderId): array
    {
        return $this->request([
            'action' => 'status',
            'order' => $orderId,
        ]);
    }

    public function multipleStatus(array $orderIds): array
    {
        return $this->request([
            'action' => 'status',
            'orders' => implode(',', $orderIds),
        ]);
    }

    public function balance(): array
    {
        return $this->request(['action' => 'balance']);
    }
}

$apiKey = getenv('NEOFOLLOWER_API_KEY');

if (!$apiKey) {
    throw new RuntimeException('Set NEOFOLLOWER_API_KEY first.');
}

$api = new NeoFollowerApi($apiKey);

print_r($api->balance());
