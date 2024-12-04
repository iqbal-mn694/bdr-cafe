<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'user_id', 
        'base_total_price', 
        'discount',
        'grand_total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }

    public function scopeForUser(EloquentBuilder $query, User $user) 
    {
        $query->where('user_id', $user->id);
    }

    public function getGrandTotal()
    {
        return number_format($this->grand_total);
    }

    public function discountAmount()
    {
        return number_format($this->discount);
    }
    
    public function baseTotalPrice()
    {
        return number_format($this->base_total_price);
    }

    public function subTotalPrice()
    {
        return number_format($this->base_total_price - $this->discount);
    }
}
