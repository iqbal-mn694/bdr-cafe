<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'base_price',
        'base_total',
        'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    } 
}