<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>

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

        /* Override Bootstrap focus state with custom colors */
        .form-control:focus, .form-select:focus, .form-control:active, .form-select:active {
            border-color: #e50914 !important;
            box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25) !important;
        }
        .form-control, .form-select {
            padding: 0.75rem;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>
    <!-- Asumsi Navbar Admin di sini, jika ada -->

    <div class="container mx-auto px-4 py-12 md:py-20">
        <div class="max-w-3xl mx-auto bg-white p-8 md:p-10 rounded-xl shadow-2xl border-t-4 border-secondary-red">
            
            <h1 class="text-4xl font-extrabold text-primary-dark mb-2">✍️ Edit Film: {{ $movie->title }}</h1>
            <p class="text-gray-600 mb-8 border-b pb-4">Perbarui informasi film dan poster jika diperlukan.</p>

            <!-- PERUBAHAN KRITIS PADA FORM: @method('PUT') dan enctype="multipart/form-data" -->
            <form action="{{ route('admin.movie.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div class="mb-4">
                    <label for="title" class="form-label block text-sm font-semibold text-gray-700 mb-1">Judul Film:</label>
                    <input type="text" name="title" id="title" class="form-control w-full border-gray-300" value="{{ old('title', $movie->title) }}" required>
                </div>

                <!-- Description Input -->
                <div class="mb-4">
                    <label for="description" class="form-label block text-sm font-semibold text-gray-700 mb-1">Deskripsi:</label>
                    <textarea name="description" id="description" class="form-control w-full border-gray-300" rows="4" required>{{ old('description', $movie->description) }}</textarea>
                </div>

                <!-- Duration Input -->
                <div class="mb-4">
                    <label for="duration" class="form-label block text-sm font-semibold text-gray-700 mb-1">Durasi (dalam menit):</label>
                    <input type="number" name="duration" id="duration" class="form-control w-full border-gray-300" value="{{ old('duration', $movie->duration) }}" required min="1">
                </div>

                <!-- Genre Input (Diubah dari text ke dropdown select) -->
                <div class="mb-4">
                    <label for="genre" class="form-label block text-sm font-semibold text-gray-700 mb-1">Genre:</label>
                    <select name="genre" id="genre" class="form-select w-full border-gray-300" required>
                        <option value="" disabled>Pilih Genre</option>
                        @php
                            $genres = ['fiksi', 'nonfiksi', 'misteri', 'fantasi', 'romansa', 'sains'];
                        @endphp
                        @foreach ($genres as $genreOption)
                            <option 
                                value="{{ $genreOption }}" 
                                {{ old('genre', $movie->genre) == $genreOption ? 'selected' : '' }}
                            >
                                {{ ucfirst($genreOption) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Release Date Input -->
                <div class="mb-4">
                    <label for="release_date" class="form-label block text-sm font-semibold text-gray-700 mb-1">Tanggal Rilis:</label>
                    <input type="date" name="release_date" id="release_date" class="form-control w-full border-gray-300" value="{{ old('release_date', $movie->release_date) }}" required>
                </div>

                <!-- Poster Input (Diubah dari URL ke File Upload) -->
                <div class="mb-6">
                    <label for="poster" class="form-label block text-sm font-semibold text-gray-700 mb-1">Ganti Poster (Opsional):</label>
                    <input type="file" name="poster" id="poster" class="form-control w-full border-gray-300 p-3" accept="image/*">
                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti poster. Maksimum 2MB.</p>
                </div>

                <!-- Current Poster Preview -->
                @if ($movie->poster)
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Poster Saat Ini:</p>
                        <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="w-32 h-auto rounded-lg shadow-md border-2 border-gray-200">
                    </div>
                @endif

                <!-- Submit Button -->
                <button type="submit" class="btn w-full py-3 font-bold text-white rounded-lg shadow-md transition duration-300 
                                             bg-secondary-red hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300">
                    Perbarui Data Film
                </button>
            </form>

            <!-- Back to Dashboard Link -->
            <div class="mt-6 text-center">
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:text-primary-dark transition duration-200">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
