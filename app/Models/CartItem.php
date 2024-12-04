<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{   
    protected $table = 'cart_items'; // atau sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function subTotal()
    {
        return number_format($this->quantity * $this->product->price);
    }


}
