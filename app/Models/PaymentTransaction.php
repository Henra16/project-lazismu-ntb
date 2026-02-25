<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Donation;


class PaymentTransaction extends Model
{
    //
    protected $fillable = [
    'donation_id',
    'gateway_name',
    'transaction_id',
    'order_id',
    'gross_amount',
    'payment_type',
    'transaction_status',
    'fraud_status',
    'signature_key',
    'raw_response'
];

protected $casts = [
    'raw_response' => 'array',
];

public function donation()
{
    return $this->belongsTo(Donation::class);
}

}
