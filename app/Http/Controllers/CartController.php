<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Products;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



// BUG
// subtotal produk tidak terkalkulasi dengan quantity
class CartController extends Controller
{
    public function cart()
    {   
        $user_id = Auth::user()->id;
        $cart = Cart::with(['items', 'items.product'])->where('user_id', $user_id)->get();
         
        $cart = $cart[0];
        $this->calculateCart($cart);

        return view('pages.cart', ['cart' => $cart]);
    }

    public function store(string $id)
    {   
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)->first();
        
        
        if(!$cart) {
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->save();
        }

        $newCart = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $id)
            ->first();

        if ($newCart) {
            DB::table('cart_items')
                ->where('cart_id', $cart->cart_id)
                ->where('product_id', $id)
                ->increment('quantity', 1);
            // $newCart->increment('quantity', 1);
        } else {
            $newCart = CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('carts');
    }

    public function updateItem(string $cart_id, string $product_id)
    {
        $cart_item = CartItem::where('cart_id', $cart_id)
            ->where('product_id', $product_id)
            ->first();

        if($cart_item) {
            $cart_item->quantity = $cart_item->quantity + 1;
            return $cart_item;
        }
        return "error";
    }

    private function calculateCart(Cart $cart)
    {
        $baseTotalPrice = 0;
        $discountAmount = 0;
        $grandTotal = 0;

        if(count($cart->items) > 0) {
            foreach ($cart->items as $item) {
                $baseTotalPrice +=  $item->quantity * $item->product->price;
            }
        }

        $grandTotal = $baseTotalPrice;
        $cart->update([
            'base_total_price' => $baseTotalPrice,
            'discount' => $discountAmount,
            'grand_total' => $grandTotal,
        ]);
    }
}
