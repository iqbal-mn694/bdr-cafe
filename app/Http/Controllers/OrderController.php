<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\RandomCharacterHelper;

class OrderController extends Controller
{
    public function storeT(Request $request)
    {   
        $user = $request->user();
        $user_id = Auth::user()->id;
        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $shipping = 2.300;

       
        $cart = Cart::with(['items', 'items.product'])->where('user_id', $user_id)->get()[0];
        $order_params = $this->makeOrderParams($user, $cart, $name, $address. $phone, $shipping);

        $order = Order::create($order_params);  
        $order->items()->saveMany($order_params['items']);
        
        $order->save();

        $code_order = $order->code;
        return redirect()->route('checkout_payment', ['order_code' => $code_order]);

    }

    public function checkoutPayment(string $order_code)
    {   $user_id = Auth::user()->id;
        $order = Order::where('code', $order_code)->first();
        if(!$order) {
            return redirect()->route('home');
        }

        Cart::where('user_id', $user_id)->delete();
        return view('pages.payment', ['order' => $order]);
    }

    public function processPayment()
    {
        return view('pages.processPayment');
    }

    public function uploadPayment(Request $request, string $order_code)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $path = $request->file('image')->store('', 'public');
        $order = Order::where('code', $order_code)->first();
        if($order) {
            $order->image = $path;
            $order->save();
            return redirect()->route('process_payment');
        }

        return redirect()->route('checkout_payment', ['order_code' => $order_code]);
    }


    public function makeOrderParams(User $user, Cart $cart, $name, $address, $phone, $shipping = 23.443)
    {
        $order_date = Carbon::now();
        $paymentDue = $order_date->addDay();

        $shipping = $shipping;
        $grand_total = $cart->grand_total;

        $params = [
            'user_id' => $user->id,
            'code' => $this->generateUniqueOrderCode(),
            'status' => "Pending",
            'order_date' => $order_date,
            'payment_due' => $paymentDue,
            'grand_total' => $grand_total,
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'shipping_cost' => $shipping,
            'grand_total' => $grand_total,
            'payment' => "BNI"
        ];

        

        $items = [];
        if($cart->items->count() > 0)
        {
            foreach ($cart->items as $item) 
            {
                $itemBasePrice = $item->product->price;
                $item_price = $itemBasePrice;
                $item_subtotal = $item_price * $item->quantity;

               $items[] = new OrderItem([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'base_price' => $itemBasePrice,
                'base_total' => $itemBasePrice * $item->quantity,
                'subtotal' => $item_subtotal,
               ]);

               
                

            }

            $params['items'] = $items;
               
        }
        return $params;
    }

    public function generateUniqueOrderCode()
    {
        $code = RandomCharacterHelper::generateOrderCode(10);

        while (Order::where('code', $code)->exists()) {
            // If the code exists, generate a new one
            $code = RandomCharacterHelper::generateOrderCode(10);
        }

        return $code;
    }
}
