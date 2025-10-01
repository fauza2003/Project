<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - GoCinema</title>

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
                        'accent-gold': '#ffc107', // Tambahkan warna untuk ikon/poin
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f4f4;
            min-height: 100vh; /* Memastikan latar belakang menutupi seluruh layar */
        }
        /* Custom styling for the list icons */
        .feature-list {
            list-style: none;
            padding-left: 0;
        }
        .feature-list li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.75rem;
        }
        /* Custom checkmark icon using ::before */
        .feature-list li::before {
            content: '✓'; 
            position: absolute;
            left: 0;
            color: #e50914; /* secondary-red */
            font-weight: bold;
            font-size: 1.1rem;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    @include('layout.header')

    <!-- Bagian Tentang Kami -->
    <div class="container py-12 md:py-20">
        <div class="about-section mx-auto max-w-4xl bg-white p-6 md:p-12 rounded-xl shadow-2xl">
            
            <!-- Judul dan Subjudul -->
            <h2 class="text-center text-5xl font-extrabold text-secondary-red mb-3">TENTANG GOCINEMA</h2>
            <p class="text-center text-gray-700 text-xl mb-10 border-b pb-4 border-gray-200">
                Selamat datang di **GoCinema**, platform terbaik untuk memesan tiket bioskop secara online! 
                Kami hadir untuk memberikan kemudahan dalam menikmati film favorit Anda dengan layanan yang cepat, aman, dan nyaman.
            </p>

            <!-- Bagian Misi/Tujuan -->
            <div class="flex flex-col md:flex-row gap-8 items-start">
                
                <div class="md:w-1/2">
                    <h3 class="text-3xl font-bold text-primary-dark mb-4 border-l-4 border-secondary-red pl-3">Misi Kami</h3>
                    <p class="text-lg text-gray-600 mb-6">
                        Misi GoCinema adalah menjadi solusi terdepan dalam pengalaman menonton film di Indonesia. Kami berupaya 
                        menghubungkan Anda dengan bioskop favorit Anda tanpa hambatan, memastikan proses pemesanan tiket 
                        secepat kilat dan semudah menggesek jari.
                    </p>

                    <h3 class="text-3xl font-bold text-primary-dark mb-4 border-l-4 border-secondary-red pl-3">Kenapa Memilih Kami?</h3>
                    <ul class="feature-list text-lg text-gray-700">
                        <li>Pemesanan tiket online yang **mudah dan aman** (didukung enkripsi).</li>
                        <li>Jadwal film terbaru yang **selalu diperbarui** secara real-time.</li>
                        <li>Notifikasi **eksklusif** untuk rilis film mendatang.</li>
                        <li>**Promo menarik** dan hadiah khusus untuk pelanggan setia.</li>
                    </ul>
                </div>

                <!-- Blok Visual/Daftar -->
                <div class="md:w-1/2 bg-gray-100 p-6 rounded-lg shadow-inner">
                    <h3 class="text-2xl font-bold text-primary-dark mb-4">Fokus Kami</h3>
                    <div class="space-y-4">
                        <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-accent-gold">
                            <p class="font-semibold text-lg text-primary-dark">Inovasi Digital</p>
                            <p class="text-sm text-gray-500">Kami terus mengembangkan fitur untuk pengalaman pemesanan yang tak tertandingi.</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-accent-gold">
                            <p class="font-semibold text-lg text-primary-dark">Kenyamanan Pengguna</p>
                            <p class="text-sm text-gray-500">Akses mudah dari mana saja, kapan saja, di perangkat apa pun.</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-accent-gold">
                            <p class="font-semibold text-lg text-primary-dark">Keamanan Transaksi</p>
                            <p class="text-sm text-gray-500">Data dan transaksi Anda dilindungi dengan teknologi keamanan terkini.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center mt-12 pt-6 border-t border-gray-200">
                <p class="text-xl font-semibold text-primary-dark mb-4">Tertarik bergabung dalam pengalaman sinematik kami?</p>
                <a href="/register" class="btn px-8 py-3 font-bold text-white rounded-lg shadow-xl transition duration-300 
                                         bg-secondary-red hover:bg-red-700 text-lg">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>

    @include('layout.footer')

    <!-- Menambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
