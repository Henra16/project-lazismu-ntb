<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Program;
use App\Models\PaymentTransaction;
use App\Models\ActivityLog;

class Donation extends Model
{
    //
    protected $fillable = [
    'uuid',
    'user_id',
    'program_id',
    'donor_name',
    'donor_email',
    'donor_phone',
    'amount',
    'admin_fee',
    'payment_method',
    'status',
    'paid_at',
    'ip_address',
    'user_agent',
    'doa',
    'is_anonymous',
];

protected $casts = [
    'paid_at'      => 'datetime',
    'is_anonymous' => 'boolean',
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

public function program()
{
    return $this->belongsTo(Program::class);
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

public function getTotalAmountAttribute(): int
{
    return (int) $this->amount + (int) ($this->admin_fee ?? 0);
}

}
