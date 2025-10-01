<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - GoCinema</title>

    <!-- Menambahkan link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link Tailwind CSS untuk styling modern (WAJIB) -->
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
        
        .movie-card-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Kritis: Memastikan tinggi card sama */
            height: 100%; 
            overflow: hidden;
            /* Penting: Mengubah container menjadi flex column agar konten tidak mendorong card ke bawah */
            display: flex;
            flex-direction: column; 
        }

        .movie-card-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .movie-card-container img {
            object-fit: cover;
            /* Kritis: Menggunakan tinggi yang seragam dengan home (350px) */
            height: 350px; 
            width: 100%;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            /* Gambar mengambil ruang tetap, sisanya untuk konten */
            flex-shrink: 0; 
        }
        
        /* Gaya tambahan untuk memastikan tombol berada di bawah secara konsisten */
        .card-content-area {
            display: flex;
            flex-direction: column;
            flex-grow: 1; /* Memastikan area konten mengambil ruang yang tersisa */
            justify-content: space-between;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    @include('layout.header')

    <div class="movies-section py-10 md:py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-extrabold text-primary-dark mb-2">🎥 Film yang Sedang Tayang</h2>
            <p class="text-gray-600 mb-5 text-lg border-b pb-4">Temukan film favoritmu dan pesan tiketnya sekarang juga!</p>

            <div class="movies-grid row -mx-2">
                @foreach (App\Models\Movie::all() as $movie)
                    <div class="col-12 col-md-4 col-lg-3 mb-8 px-3">
                        <div class="movie-card-container h-full">
                            
                            <!-- GAMBAR POSTER -->
                            <img 
                                src="{{ asset('storage/' . $movie->poster) }}" 
                                alt="{{ $movie->title }}" 
                                class="rounded-t-xl"
                                onerror="this.onerror=null; this.src='https://placehold.co/600x350/363636/ffffff?text=Poster+Not+Found'">
                            
                            <!-- AREA KONTEN (Penyebab utama peregangan) -->
                            <div class="p-4 card-content-area">
                                
                                <!-- Div untuk Judul & Rating (Dibatasi tingginya) -->
                                <div class="min-h-20 mb-3"> 
                                    <h3 class="text-lg font-bold text-primary-dark mb-1 truncate">{{ $movie->title }}</h3>
                                    <p class="text-sm text-gray-600">
                                        <span class="text-accent-gold font-semibold">⭐ {{ $movie->rating ?? 'N/A' }}</span> | {{ $movie->genre }}
                                    </p>
                                </div>
                                
                                <!-- Div untuk Tombol Aksi -->
                                <div class="mt-auto">
                                @auth
                                    @if (Auth::user()->is_admin != 1)
                                        <!-- Tampilkan tombol jika user bukan admin -->
                                        <a href="{{ route('order', ['movieTitle' => $movie->title]) }}" 
                                           class="btn w-full bg-secondary-red text-white border-0 hover:bg-red-700 font-semibold rounded-lg transition duration-200">
                                            Pesan Tiket
                                        </a>
                                    @endif
                                @else
                                    <!-- Tampilkan pesan jika user belum login -->
                                    <p class="text-sm mt-3 text-center">
                                        Anda harus <a href="{{ route('login') }}" class="text-secondary-red font-bold hover:underline">login</a> untuk memesan tiket.
                                    </p>
                                @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('layout.footer')

    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
