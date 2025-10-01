<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - GoCinema</title>

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
                        'info-blue': '#1e40af', // Biru gelap untuk info
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

        /* Styling kustom untuk tabel */
        .table-custom th {
            background-color: #1a1a1a;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.875rem;
        }
        .table-custom td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    @include('layout.header')

    <div class="container mx-auto px-4 py-12 md:py-16">
        <div class="bg-white p-6 md:p-8 rounded-xl shadow-2xl">
            
            <h1 class="text-4xl font-extrabold text-primary-dark mb-2">🎟️ Riwayat Pesanan Anda</h1>
            <p class="text-gray-600 mb-6 border-b pb-4">Daftar semua tiket yang pernah Anda pesan melalui GoCinema.</p>

            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg shadow-md" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg shadow-md" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!-- TABLE CONTAINER (untuk responsivitas) -->
            @if(count($orders) > 0)
                <div class="overflow-x-auto shadow-md rounded-lg">
                    <table class="table table-custom w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left w-1/12">ID Pesanan</th>
                                <th class="px-4 py-3 text-left w-4/12">Nama Film</th>
                                <th class="px-4 py-3 text-left w-3/12">Tanggal Pesanan</th>
                                <th class="px-4 py-3 text-center w-2/12">Status</th>
                                <th class="px-4 py-3 text-center w-2/12">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-semibold text-primary-dark">{{ $order->id }}</td>
                                    <td class="px-4 py-3 font-semibold text-primary-dark">{{ $order->movie_title }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <!-- Asumsi ada kolom 'status' di tabel orders. Jika tidak ada, Anda bisa membuatnya di Controller. -->
                                        @php $status = 'Berhasil'; @endphp 
                                        <span class="inline-block bg-success-green text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center whitespace-nowrap">
                                        <a href="{{ route('user.showOrder', $order->id) }}" class="btn btn-info btn-sm bg-info-blue hover:bg-blue-800 text-white font-bold action-btn">
                                            Lihat Detail
                                        </a>
                                        
                                        <!-- Form Cancel Order -->
                                        <form action="{{ route('user.cancelOrder', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini? Aksi ini tidak dapat dibatalkan.')">
                                            @csrf
                                            <button type="submit" class="btn bg-secondary-red hover:bg-red-700 text-white font-bold action-btn">
                                                Batalkan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert bg-yellow-100 border-l-4 border-accent-gold p-4 rounded-lg text-gray-700 font-semibold shadow-sm">
                    Anda belum melakukan pemesanan tiket di GoCinema.
                </div>
                <div class="text-center mt-6">
                    <a href="{{ route('home') }}" class="btn bg-secondary-red hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                        Pesan Tiket Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>

    @include('layout.footer')

    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
