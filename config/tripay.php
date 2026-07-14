<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tripay API Credentials
    |--------------------------------------------------------------------------
    | Isi nilai berikut di .env Anda:
    |   TRIPAY_API_KEY        = API Key dari Dashboard Tripay > Developer > API
    |   TRIPAY_PRIVATE_KEY    = Private Key dari Dashboard Tripay > Developer > API
    |   TRIPAY_MERCHANT_CODE  = Kode Merchant (contoh: T12345)
    |   TRIPAY_IS_PRODUCTION  = true/false
    */

    'api_key'       => env('TRIPAY_API_KEY', ''),
    'private_key'   => env('TRIPAY_PRIVATE_KEY', ''),
    'merchant_code' => env('TRIPAY_MERCHANT_CODE', ''),
    'is_production' => env('TRIPAY_IS_PRODUCTION', false),

    /*
    |--------------------------------------------------------------------------
    | API Base URL (otomatis tergantung is_production)
    |--------------------------------------------------------------------------
    */
    'base_url' => env('TRIPAY_IS_PRODUCTION', false)
        ? 'https://tripay.co.id/api/'
        : 'https://tripay.co.id/api-sandbox/',

];
