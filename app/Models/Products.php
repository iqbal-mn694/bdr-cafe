<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    protected $fillable = [
        'product_name',
        'product_code',
        'price',
        'category',
        'image'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}
