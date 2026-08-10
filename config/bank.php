<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Manual Bank Transfer Details
    |--------------------------------------------------------------------------
    | Digunakan untuk instruksi transfer manual kepada donatur.
    | Set nilai ini via environment variable di server production.
    */

    'name'      => env('MANUAL_BANK_NAME', 'Bank Muamalat'),
    'account'   => env('MANUAL_BANK_ACCOUNT', '7210063046'),
    'recipient' => env('MANUAL_BANK_RECIPIENT', 'Lazis MUHAMMADIYAH'),

];
