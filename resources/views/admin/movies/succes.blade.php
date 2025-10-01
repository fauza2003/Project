<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penghapusan Berhasil</title>

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
            border-left: 5px solid #e50914; /* Aksen Merah */
            border-radius: 0.75rem;
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-12 md:py-20">
        <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-2xl success-card">
            
            <h1 class="text-4xl font-extrabold text-primary-dark mb-4">✅ Berhasil!</h1>

            <div class="alert alert-success bg-red-50 text-secondary-red border-secondary-red p-4 rounded-lg" role="alert">
                <p class="font-semibold text-lg">
                    Film **{{ $movie->title }}** telah berhasil dihapus dari sistem GoCinema.
                </p>
                <p class="text-sm mt-2 text-gray-700">Data film beserta filenya telah dibersihkan dari *database* dan *storage*.</p>
            </div>

            <!-- Back to Movie List Button -->
            <div class="mt-6">
                <a href="{{ route('admin.movie.index') }}" 
                   class="btn w-full py-3 font-bold text-white rounded-lg shadow-md transition duration-300 
                          bg-primary-dark hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300">
                    ← Kembali ke Daftar Film
                </a>
            </div>
        </div>
    </div>

    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
