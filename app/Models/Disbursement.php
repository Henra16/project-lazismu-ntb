<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    protected $fillable = [
        'program_id',
        'amount',
        'recipient',
        'purpose',
        'disbursed_at',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
