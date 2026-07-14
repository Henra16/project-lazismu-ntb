<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Donation;
use App\Models\User;


class Campaign extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'description',
        'target_amount',
        'deadline',
        'status',
        'image',
        'category',
        'created_by',
    ];

    protected static function booted()
    {
        static::creating(function ($campaign) {
            $campaign->uuid = (string) \Illuminate\Support\Str::uuid();
            if (empty($campaign->slug)) {
                $campaign->slug = \Illuminate\Support\Str::slug($campaign->title);
            }
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

    public function getCollectedAttribute()
    {
        return $this->donations()->where('status', 'paid')->sum('amount');
    }
}
