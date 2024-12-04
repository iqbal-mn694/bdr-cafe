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
        <!-- Notifikasi setelah pembayaran -->
            <div id="confirmation-box">
                <h2>Pembayaran Sedang Diproses</h2>
                <p>Terima kasih telah melakukan pembayaran. Mohon tunggu beberapa saat.</p>
                <a href="/">
                    <button id="home-btn">Kembali ke Home</button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
