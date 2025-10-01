<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Movies</title>

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

        /* Styling tambahan untuk tabel agar responsif dan terlihat bersih */
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
        .action-btn {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>
    <!-- Asumsi Navbar Admin di sini, jika ada -->
    
    <div class="container mx-auto px-4 py-12 md:py-16">
        <div class="bg-white p-6 md:p-8 rounded-xl shadow-2xl">
            
            <h1 class="text-4xl font-extrabold text-primary-dark mb-2">🎬 Kelola Film Tayang</h1>
            <p class="text-gray-600 mb-6">Daftar lengkap film, termasuk durasi, genre, dan aksi manajemen.</p>

            <a href="{{ route('admin.movie.create') }}" class="btn bg-secondary-red hover:bg-red-700 text-white font-bold mb-4 rounded-lg transition duration-200">
                + Tambah Film Baru
            </a>

            <!-- TABLE CONTAINER (untuk responsivitas) -->
            <div class="overflow-x-auto shadow-md rounded-lg">
                <table class="table table-custom w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left w-1/12">ID</th>
                            <th class="px-4 py-3 text-left w-2/12">Poster</th>
                            <th class="px-4 py-3 text-left w-3/12">Judul</th>
                            <th class="px-4 py-3 text-left w-4/12">Detail</th>
                            <th class="px-4 py-3 text-center w-2/12">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movies as $movie)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $movie->id }}</td>
                                <td class="px-4 py-3">
                                    @if($movie->poster)
                                        <img src="{{ asset('storage/' . $movie->poster) }}" alt="Poster" class="w-12 h-auto rounded shadow-md">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-semibold text-primary-dark">{{ $movie->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    <p class="mb-1"><strong>Genre:</strong> {{ ucfirst($movie->genre) }}</p>
                                    <p class="mb-1"><strong>Durasi:</strong> {{ $movie->duration }} menit</p>
                                    <p class="mb-0"><strong>Rilis:</strong> {{ $movie->release_date }}</p>
                                </td>
                                <td class="px-4 py-3 text-center whitespace-nowrap">
                                    <!-- Edit Movie Button -->
                                    <a href="{{ route('admin.movie.edit', $movie->id) }}" class="action-btn btn bg-yellow-500 hover:bg-yellow-600 text-white font-bold mr-2">
                                        Edit
                                    </a>

                                    <!-- Delete Movie Form -->
                                    <form action="{{ route('admin.movie.destroy', $movie->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus film {{ $movie->title }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn bg-secondary-red hover:bg-red-700 text-white font-bold">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Back to Dashboard Link -->
            <div class="mt-6 text-center">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary bg-gray-600 hover:bg-gray-700 text-white font-bold transition duration-200">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
