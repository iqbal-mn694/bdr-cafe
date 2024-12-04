<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembayaran</title>
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
</head>
<body>
    <div class="container">
        <div class="payment-box">
            <h1>HALAMAN PEMBAYARAN</h1>
            <hr>
            <p class="amount-label">TOTAL YANG HARUS DIBAYAR</p>
            <p class="amount">Rp. {{ number_format($order->grand_total ) }}</p>
            <p class="order-number">No Pesanan Anda : {{ $order->code }}</p>

            <p class="payment-method-title">METODE PEMBAYARAN</p>
            <div class="payment-methods">
                <div class="method">
                    <img src="{{ asset('assets/bank-bri.png')}}" alt="Logo BRI">
                    <p>BRI: 1234567</p>
                </div>
                <div class="method">
                    <img src="{{ asset('assets/ovo.png')}}" alt="Logo OVO">
                    <p>OVO: 085262794214</p>
                </div>
                <div class="method">
                    <img src="{{ asset('assets/dana.jpg')}}" alt="Logo DANA">
                    <p>DANA: 085821897243</p>
                </div>
            </div>

            <form action="{{ url('payment/' . $order->code) }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="payment-proof">UPLOAD BUKTI PEMBAYARAN</label>
                <input type="file" id="payment-proof" name="image" accept="image/*" required>

                <button type="submit">KONFIRMASI PEMBAYARAN</button>
            </form>
        </div>
        
    </div>
</body>
</html>
