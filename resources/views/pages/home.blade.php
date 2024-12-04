<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>WebApp Caffe</title>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('assets/logo.svg') }}" alt="logo">
        </div>

        <div class="menu">
            <a href="#home">Home</a>
            <a href="{{ url('carts') }}">Shop</a>
            <a href="#features">Features</a>
            <a href="#contact">Contact</a>
        </div>

        @if(!auth()->check())
        <div class="login">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <button name="button" class="login">Login</button>
            </form>
        </div>
        @else
        <div class="login">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                @method('DELETE')
                <button name="button" class="login">Logout</button>
            </form>
        </div>
        @endif
        

        <form class="search">
    <input type="search" placeholder="Search">
      </form>
    </nav>

<!-- mencari produk -->
<!-- <form class="search">
    <input type="search" placeholder="Search">
      </form> -->

    <div class="hero-banner">
        <img src="{{ asset('assets/banner.png') }}" alt="">
    </div>   

<!-- Gambar Produk -->
<div class="menu-container">
@foreach($products as $product)
    <div class="menu-item">
        <a href="{{ url('/products/' . $product->id) }}" class="menu-link">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}" class="menu-image">
            <div class="menu-details">
                <p class="menu-name">{{ $product->product_name }}</p>
                <p class="menu-rating">5.0 ★</p>
                <p class="menu-price">Rp. {{ number_format( $product->price ) }}</p>
            </div>
        </a>
        <a href="{{ url('/carts/product/' . $product->id) }}" class="menu-cart">🛒</a>
    </div>
    @endforeach
    </div>
</body>
</html>