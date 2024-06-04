<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'topic',
        'name',
        'email',
        'feedback',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
