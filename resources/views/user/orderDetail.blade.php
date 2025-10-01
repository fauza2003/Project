<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - GoCinema</title>

    <!-- Menambahkan link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link Tailwind CSS untuk styling modern -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary-dark': '#1a1a1a',
                        'secondary-red': '#e50914',
                        'accent-gold': '#ffc107',
                        'info-blue': '#1e40af', 
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f4f4;
            min-height: 100vh;
        }
        .detail-card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .info-block {
            border-left: 4px solid #e50914; /* Aksen merah */
        }
        .info-label {
            color: #1a1a1a;
            font-weight: 700;
        }
    </style>
</head>

<body>
    @include('layout.header')

    <div class="container mx-auto px-4 py-12 md:py-16">
        <div class="detail-card p-6 md:p-10 max-w-4xl mx-auto">
            
            <h1 class="text-4xl font-extrabold text-primary-dark mb-2">🎬 Detail Pesanan #{{ $order->id }}</h1>
            <p class="text-gray-600 mb-8 border-b pb-4">Rincian lengkap pesanan tiket film Anda.</p>

            <div class="row">
                <!-- Kolom Kiri: Informasi Pemesan dan Film -->
                <div class="col-lg-7">
                    
                    <!-- INFORMASI PEMESAN -->
                    <div class="mb-6">
                        <h5 class="text-xl font-bold text-secondary-red mb-3">1. Informasi Pemesan</h5>
                        <div class="space-y-3">
                            <div class="info-block p-3 bg-gray-50 rounded-md">
                                <p class="mb-0 text-md"><span class="info-label">Nama:</span> <span class="ml-2">{{ $order->name }}</span></p>
                            </div>
                            <div class="info-block p-3 bg-gray-50 rounded-md">
                                <p class="mb-0 text-md"><span class="info-label">Email:</span> <span class="ml-2">{{ $order->email }}</span></p>
                            </div>
                            <div class="info-block p-3 bg-gray-50 rounded-md">
                                <p class="mb-0 text-md"><span class="info-label">Tanggal Pesanan:</span> <span class="ml-2">{{ $order->created_at->format('d M Y H:i') }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- INFORMASI PESANAN -->
                    <div class="mb-6">
                        <h5 class="text-xl font-bold text-secondary-red mb-3">2. Rincian Film</h5>
                        <div class="space-y-3">
                            <div class="info-block p-3 bg-gray-50 rounded-md">
                                <p class="mb-0 text-md"><span class="info-label">Nama Film:</span> <span class="ml-2 font-bold">{{ $order->movie_title }}</span></p>
                            </div>
                            <div class="info-block p-3 bg-gray-50 rounded-md">
                                <p class="mb-0 text-md"><span class="info-label">Jumlah Tiket:</span> <span class="ml-2">{{ $order->quantity }}</span></p>
                            </div>
                            <!-- Status -->
                            <div class="info-block p-3 bg-gray-50 rounded-md">
                                @php
                                    // Asumsi status adalah 'confirmed', 'pending', atau 'cancelled'
                                    $statusClass = $order->status == 'cancelled' ? 'bg-red-500' : 'bg-green-500';
                                    $statusText = $order->status == 'cancelled' ? 'DIBATALKAN' : 'BERHASIL';
                                @endphp
                                <p class="mb-0 text-md"><span class="info-label">Status:</span> 
                                    <span class="ml-2 inline-block {{ $statusClass }} text-white text-xs font-bold px-2 py-1 rounded-full">{{ $statusText }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Kolom Kanan: Kursi dan Total -->
                <div class="col-lg-5 mt-6 lg:mt-0">
                    <div class="bg-primary-dark text-white p-6 rounded-xl shadow-lg h-full">
                        <h5 class="text-2xl font-extrabold text-accent-gold mb-4">Rincian Kursi</h5>
                        
                        <!-- Kursi Dipilih -->
                        <p class="mb-4 text-lg">
                            <span class="font-semibold">Kursi:</span>
                            <span class="block mt-2 text-xl font-bold text-secondary-red">
                                @php
                                    // Pastikan data kursi diproses dengan benar
                                    $seatsArray = is_string($order->seats) ? json_decode($order->seats) : $order->seats;
                                @endphp
                                {{ is_array($seatsArray) ? implode(', ', $seatsArray) : 'N/A' }}
                            </span>
                        </p>

                        <hr class="border-gray-700 my-4">

                        <!-- Total Pembayaran -->
                        <h5 class="text-2xl font-extrabold mb-2">Total Pembayaran</h5>
                        <p class="text-4xl font-extrabold text-accent-gold">
                            Rp 50.000 x {{ $order->quantity }} = 
                            @php
                                $totalPrice = $order->quantity * 50000; // Asumsi harga Rp 50.000
                                echo number_format($totalPrice, 0, ',', '.');
                            @endphp
                        </p>
                    </div>
                </div>
            </div>

            <!-- Aksi -->
            <div class="mt-8 border-t pt-4">
                <a href="{{ route('user.history') }}" class="btn bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    ← Kembali ke Riwayat Pesanan
                </a>
                
                @if($order->status != 'cancelled')
                    <form action="{{ route('user.cancelOrder', $order->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg-secondary-red hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200" onclick="return confirm('Anda yakin ingin membatalkan pesanan ini? Aksi ini tidak dapat dibatalkan.')">
                            Batalkan Pesanan
                        </button>
                    </form>
                @else
                    <span class="text-red-500 font-semibold ml-3">Pesanan ini sudah dibatalkan.</span>
                @endif
            </div>

        </div>
    </div>

    @include('layout.footer')

    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
