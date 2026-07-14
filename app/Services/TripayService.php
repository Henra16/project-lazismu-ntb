<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TripayService
{
    protected string $apiKey;
    protected string $privateKey;
    protected string $merchantCode;
    protected bool $isProduction;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey       = config('tripay.api_key');
        $this->privateKey   = config('tripay.private_key');
        $this->merchantCode = config('tripay.merchant_code');
        $this->isProduction = config('tripay.is_production');
        $this->baseUrl      = config('tripay.base_url');
    }

    /**
     * Map metode pembayaran internal ke kode channel Tripay.
     */
    public static function mapChannel(string $method): string
    {
        return match ($method) {
            'qris'           => 'QRIS',
            'va_bri'         => 'BRIVA',
            'va_bni'         => 'BNIVA',
            'va_bca'         => 'BCAVA',
            'va_bsi'         => 'BSIVA',
            default          => 'QRIS',
        };
    }

    /**
     * Hitung biaya admin Tripay berdasarkan channel.
     */
    public static function calculateAdminFee(string $method, int $amount): int
    {
        return match ($method) {
            'qris'   => (int) ceil($amount * 0.005),  // 0.5%
            'va_bri' => 1500,
            'va_bni' => 2500,
            'va_bca' => 3500,
            'va_bsi' => 2500,
            default  => 0,
        };
    }

    /**
     * Buat transaksi Closed Payment ke API Tripay.
     *
     * @param  array $data  Data transaksi
     * @return array        Response dari Tripay (data transaksi)
     * @throws \Exception   Jika request gagal
     */
    public function createTransaction(array $data): array
    {
        $signature = hash_hmac(
            'sha256',
            $this->merchantCode . $data['merchant_ref'] . $data['amount'],
            $this->privateKey
        );

        $payload = [
            'method'         => $data['channel_code'],
            'merchant_ref'   => $data['merchant_ref'],
            'amount'         => $data['amount'],
            'customer_name'  => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'],
            'order_items'    => $data['order_items'],
            'callback_url'   => $data['callback_url'],
            'return_url'     => $data['return_url'],
            'expired_time'   => now()->addHours(24)->timestamp,
            'signature'      => $signature,
        ];

        Log::info('Tripay Create Transaction Request', [
            'merchant_ref' => $data['merchant_ref'],
            'channel'      => $data['channel_code'],
            'amount'       => $data['amount'],
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->post($this->baseUrl . 'transaction/create', $payload);

        $result = $response->json();

        if (!$response->successful() || !($result['success'] ?? false)) {
            $message = $result['message'] ?? 'Tripay API error';
            Log::error('Tripay Create Transaction Failed', [
                'response' => $result,
                'status'   => $response->status(),
            ]);
            throw new \Exception('Gagal membuat transaksi Tripay: ' . $message);
        }

        Log::info('Tripay Transaction Created', [
            'reference'   => $result['data']['reference'] ?? null,
            'payment_url' => $result['data']['checkout_url'] ?? null,
        ]);

        return $result['data'];
    }

    /**
     * Verifikasi signature dari callback Tripay.
     * Formula: HMAC-SHA256(private_key, json_payload)
     */
    public function verifyCallbackSignature(string $rawBody, string $receivedSignature): bool
    {
        $expectedSignature = hash_hmac('sha256', $rawBody, $this->privateKey);
        return hash_equals($expectedSignature, $receivedSignature);
    }

    /**
     * Ambil daftar channel pembayaran yang aktif.
     */
    public function getPaymentChannels(): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get($this->baseUrl . 'merchant/payment-channel');

        $result = $response->json();

        if (!$response->successful() || !($result['success'] ?? false)) {
            Log::warning('Tripay: Gagal mengambil daftar channel', ['response' => $result]);
            return [];
        }

        return $result['data'] ?? [];
    }
}
