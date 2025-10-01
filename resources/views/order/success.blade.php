<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Sukses - GoCinema</title>

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
                        'success-green': '#198754', // Hijau untuk Sukses
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

        .success-card {
            border-top: 5px solid #198754; /* Aksen Hijau */
            border-radius: 1rem;
        }
        .icon-large {
            font-size: 5rem;
            line-height: 1;
        }
    </style>
</head>

<body>
    <!-- Asumsi Anda memiliki include header/navbar di sini jika diperlukan -->

    <div class="container mx-auto px-4 py-12 md:py-20">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="success-card bg-white p-8 md:p-10 rounded-xl shadow-2xl text-center">
                    
                    <!-- Ikon Sukses -->
                    <div class="text-success-green icon-large mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <path d="M22 4 12 14.01l-3-3"></path>
                        </svg>
                    </div>

                    <h1 class="text-4xl font-extrabold text-success-green mb-3">Pesanan Berhasil!</h1>
                    
                    <p class="lead text-gray-700 mb-4">
                        Terima kasih telah memesan tiket di **GoCinema**. Pesanan Anda telah berhasil diproses.
                    </p>
                    <p class="text-md text-gray-500 mb-6">
                        Tiket Anda (e-ticket) akan segera dikirimkan ke email konfirmasi Anda.
                    </p>

                    <!-- Tombol Aksi -->
                    <div class="space-y-3">
                        <a href="{{ url('/user/history') }}" class="btn w-full py-3 font-bold text-white rounded-lg shadow-md transition duration-300 
                                         bg-primary-dark hover:bg-gray-800">
                            Lihat Riwayat Pesanan
                        </a>
                        <a href="{{ url('/') }}" class="btn w-full py-3 font-bold text-white rounded-lg shadow-md transition duration-300 
                                         bg-secondary-red hover:bg-red-700">
                            Kembali ke Halaman Utama
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
