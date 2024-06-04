<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;
    protected $fillable = [
        'expired_Time',
    ];

    protected $casts = [
        'expired_Time' => 'time',
    ];
    protected $table = 'otp';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
