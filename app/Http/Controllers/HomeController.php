<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class HomeController extends Controller
{
    public function home() 
    {
        $products = Products::all();
        // dd($products);
        return view('pages.home', ['products' => $products]);
    }
}
