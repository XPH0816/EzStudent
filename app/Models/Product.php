<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'image',
        'price',
        'category',
        'quantity',
        'size'
    ];

    protected $casts = [
        'price' => 'double',
    ];
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, "order_item")->withPivot('qty');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Str::startsWith($value, 'http') ? $value : Storage::url($value),
        );
    }
}
