<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(string $id)
    {
        $product = Products::where('id', $id)
            ->get();
        
        return view('pages.detail-product', ['product' => $product]);

    }
}
