<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoCinema - Film Terbaik Hari Ini</title>

    <!-- Menambahkan link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Ganti ke font yang lebih modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

    <!-- Ganti ke Tailwind CSS untuk styling tambahan dan font Inter -->
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

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>

    <style>
        /* Terapkan font Inter */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f4f4;
        }

        /* --- STYLING LIST HORIZONTAL BARU --- */
        .movies-list-horizontal {
            display: flex;
            overflow-x: scroll; /* Kritis: Memungkinkan scrolling horizontal */
            padding-bottom: 1.5rem; /* Memberi ruang untuk scrollbar */
            scrollbar-width: thin; /* Firefox */
            scrollbar-color: #e50914 #ddd; /* Warna scrollbar */
            scroll-snap-type: x mandatory; /* Opsional: Untuk snapping saat scroll */
            margin-left: -1rem; /* Kompensasi padding/margin kartu */
            margin-right: -1rem;
        }
        
        .movie-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 250px; /* Lebar tetap untuk scrolling yang rapi */
            flex-shrink: 0; /* Penting: Mencegah card membesar */
            margin: 0 1rem;
            scroll-snap-align: start;
        }

        .movie-card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .movie-card img {
            object-fit: cover;
            height: 350px; 
            width: 100%;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        /* Hilangkan elemen slider yang tidak digunakan */
        .arrow, .dot, .slide {
            display: none !important;
        }

        /* Styling Location Selector (tetap) */
        .location-select:focus {
            border-color: #e50914 !important;
            box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25) !important;
        }
    </style>
</head>

<body>
    @include('layout.header')

    <!-- Location Selector -->
    <section class="bg-white shadow-md py-3 mb-5">
        <div class="container flex items-center justify-center">
            <span id="location-text" class="text-xl font-bold text-secondary-red mr-2">📍 MALANG</span>
            <select id="location-selector" class="form-select w-auto border-gray-300 rounded-lg shadow-sm focus:border-secondary-red focus:ring focus:ring-secondary-red focus:ring-opacity-50">
                <option value="MALANG">MALANG</option>
                <option value="JAKARTA">JAKARTA</option>
                <option value="SURABAYA">SURABAYA</option>
                <option value="BANDUNG">BANDUNG</option>
                <option value="YOGYAKARTA">YOGYAKARTA</option>
            </select>
        </div>
    </section>

    <!-- Script Location -->
    <script>
        // Ambil elemen untuk lokasi dan dropdown
        const locationText = document.getElementById('location-text');
        const locationSelector = document.getElementById('location-selector');

        // Ketika pilihan lokasi berubah, update teks lokasi
        locationSelector.addEventListener('change', function() {
            locationText.textContent = `📍 ${locationSelector.value}`;
        });
    </script>

    <!-- Now Showing -->
    <main>
        <section id="now-showing" class="movies-section py-8 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-center text-4xl font-extrabold text-primary-dark mb-8">🎥 Sedang Tayang</h2>
                
                <!-- CONTAINER LIST HORIZONTAL BARU -->
                <div class="movies-list-horizontal">
                    @php
                        // Ambil semua film tanpa chunking
                        $movies = App\Models\Movie::all();
                    @endphp
                    
                    @foreach ($movies as $movie)
                        <!-- Card Film Individual -->
                        <div class="movie-card">
                            <!-- PERBAIKAN PATH POSTER -->
                            <img src="{{ asset('storage/' . $movie->poster) }}" 
                                alt="{{ $movie->title }}" 
                                class="img-fluid rounded-t-xl shadow-md"
                                onerror="this.onerror=null; this.src='https://placehold.co/600x400/363636/ffffff?text=Poster+Not+Found'">
                            
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-primary-dark truncate mb-1">{{ $movie->title }}</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    <span class="text-accent-gold">⭐ {{ $movie->rating ?? 'N/A' }}</span> | {{ $movie->genre }}
                                </p>
                                @auth
                                    @if (Auth::user()->is_admin != 1)
                                        <!-- Tampilkan tombol jika user bukan admin -->
                                        <a href="{{ route('order', ['movieTitle' => $movie->title]) }}" 
                                           class="btn bg-secondary-red text-white hover:bg-red-700 w-full rounded-lg font-semibold transition duration-200 py-2">
                                            Pesan Tiket
                                        </a>
                                    @endif
                                @else
                                    <!-- Tampilkan pesan jika user belum login -->
                                    <p class="text-danger text-sm mt-3">Anda harus <a href="{{ route('login') }}" class="text-secondary-red font-bold hover:underline">login</a> untuk memesan tiket.</p>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- AKHIR CONTAINER LIST HORIZONTAL -->
            </div>
        </section>

        <!-- Movie Details (Desain Ulang) -->
        <section class="movie-details bg-primary-dark text-white py-12">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-5xl font-extrabold mb-3">WICKED - Segera Hadir</h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Rating film ini <span class="text-accent-gold">⭐ 9.3</span>. Penasaran nggak sebagus apa? Tonton aja langsung di bioskop terdekat!
                </p>
            </div>
        </section>
    </main>

    @include('layout.footer')

    <!-- Menambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Slider Initialization (Dihapus karena tidak lagi carousel) -->
    <script>
        // Logika slider dihilangkan, hanya menyisakan logic Location Selector di atas.
    </script>
</body>

</html>
