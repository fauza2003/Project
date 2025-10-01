<!-- orderConfirmation.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pemesanan - GoCinema</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('layout.header')

    <!-- Order Confirmation Section -->
    <div class="container">
        <h2>Pesanan Anda Berhasil!</h2>
        <p>Terima kasih telah memesan tiket di GoCinema. Pesanan Anda telah diproses dengan sukses. Kami akan segera mengirimkan konfirmasi ke email Anda.</p>
        <a href="/" class="btn btn-primary">Kembali ke Halaman Utama</a>
    </div>

    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
