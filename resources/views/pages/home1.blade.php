<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<h1>Halaman Produk</h1>
<a href="{{ url('/carts') }}">
  <Button>Keranjang</Button>
</a>

@foreach($products as $product)
    <a href="{{ url('/products/' . $product->id) }}">
      <p>Produk: {{ $product->product_name }}</p>
    </a>
    <p>Kode Barang: {{ $product->product_code }}</p>
    <p>Kategori: {{ $product->product_category }}</p>
    <p>Harga: {{ $product->price }}</p>
    <a href="{{ url('/carts/product/' . $product->id) }}">Tambahkan ke keranjang
    </a>
    <br>
    <br>
@endforeach

  <form action="{{ route('logout') }}" method="post">
    @csrf
    @method('DELETE')
    <button>Logout</button>
  </form>
</body>
</html>