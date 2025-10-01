<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

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
        .dashboard-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Asumsi Anda memiliki include header/navbar yang berbeda untuk admin -->
    <nav class="bg-primary-dark shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-extrabold text-secondary-red">GoCinema Admin</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-white hover:text-secondary-red transition duration-200">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-12 md:py-20">
        <h1 class="text-5xl font-extrabold text-primary-dark mb-8 border-b-4 border-secondary-red pb-2">
            Selamat Datang, Admin!
        </h1>

        <!-- Admin Action Buttons (Grid Layout) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Tambah Film -->
            <a href="{{ route('admin.movie.create') }}" class="dashboard-card bg-white p-6 rounded-xl shadow-lg border-l-4 border-secondary-red block">
                <h5 class="text-2xl font-bold text-primary-dark mb-2">🎬 Tambah Film Baru</h5>
                <p class="text-gray-600 mb-1">Masukkan data film, durasi, genre, dan unggah poster.</p>
                <span class="text-secondary-red font-semibold text-sm mt-2 block">Lanjutkan →</span>
            </a>
            
            <!-- Kelola Film -->
            <a href="{{ route('admin.movie.index') }}" class="dashboard-card bg-white p-6 rounded-xl shadow-lg border-l-4 border-primary-dark block">
                <h5 class="text-2xl font-bold text-primary-dark mb-2">⭐ Kelola Film Tayang</h5>
                <p class="text-gray-600 mb-1">Lihat, edit, dan hapus semua data film dari sistem.</p>
                <span class="text-primary-dark font-semibold text-sm mt-2 block">Lanjutkan →</span>
            </a>
            
            <!-- Kelola Akun -->
            <a href="{{ route('admin.users.index') }}" class="dashboard-card bg-white p-6 rounded-xl shadow-lg border-l-4 border-primary-dark block">
                <h5 class="text-2xl font-bold text-primary-dark mb-2">👥 Kelola Akun Pengguna</h5>
                <p class="text-gray-600 mb-1">Lihat dan kelola semua akun pengguna yang terdaftar.</p>
                <span class="text-primary-dark font-semibold text-sm mt-2 block">Lanjutkan →</span>
            </a>
        </div>

        <!-- Back to Home Button -->
        <div class="mt-8">
            <a href="{{ route('home') }}" class="btn bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                ← Kembali ke Halaman Utama
            </a>
        </div>
    </div>

    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
