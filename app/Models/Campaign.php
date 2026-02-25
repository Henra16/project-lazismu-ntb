<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Donation;
use App\Models\User;


class Campaign extends Model
{
    //

    protected $fillable = [
    'uuid',
    'name',
    'email',
    'phone',
    'password',
    'role',
];

protected static function booted()
{
    static::creating(function ($user) {
        $user->uuid = Str::uuid();
    });
}

public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

public function donations()
{
    return $this->hasMany(Donation::class);
}

}
