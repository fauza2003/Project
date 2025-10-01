<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penambahan Berhasil</title>

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
                        'success-green': '#198754', // Hijau Bootstrap/Tailwind
                        'success-light': '#d1e7dd',
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
            border-left: 5px solid #198754; /* Aksen Hijau untuk Sukses */
            border-radius: 0.75rem;
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-12 md:py-20">
        <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-2xl success-card">
            
            <h1 class="text-4xl font-extrabold text-primary-dark mb-4">🎉 Film Ditambahkan!</h1>

            <!-- Mengganti alert ke success/green -->
            <div class="alert bg-success-light text-success-green border-success-green p-4 rounded-lg" role="alert">
                <p class="font-semibold text-lg text-primary-dark">
                    Film baru Anda telah berhasil ditambahkan ke sistem GoCinema.
                </p>
                <p class="text-sm mt-2 text-gray-700">Film ini siap untuk ditayangkan dan dipesan tiketnya oleh pengguna.</p>
            </div>

            <!-- Back to Dashboard Button -->
            <div class="mt-6">
                <a href="{{ route('admin.dashboard') }}" 
                   class="btn w-full py-3 font-bold text-white rounded-lg shadow-md transition duration-300 
                          bg-primary-dark hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
