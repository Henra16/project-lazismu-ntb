<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Campaign;
use App\Models\PaymentTransaction;
use App\Models\ActivityLog;

class Donation extends Model
{
    //
    protected $fillable = [
    'uuid',
    'user_id',
    'campaign_id',
    'donor_name',
    'donor_email',
    'donor_phone',
    'amount',
    'payment_method',
    'status',
    'paid_at',
    'ip_address',
    'user_agent'
];

protected $casts = [
    'paid_at' => 'datetime',
];

protected static function booted()
{
    static::creating(function ($donation) {
        $donation->uuid = Str::uuid();
    });
}

public function user()
{
    return $this->belongsTo(User::class);
}

public function campaign()
{
    return $this->belongsTo(Campaign::class);
}

public function transaction()
{
    return $this->hasOne(PaymentTransaction::class);
}

public function activityLogs()
{
    return $this->hasMany(ActivityLog::class);
}
public function getRouteKeyName()
{
    return 'uuid';
}

}
