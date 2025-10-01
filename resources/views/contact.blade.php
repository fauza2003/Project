<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - GoCinema</title>

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
        }

        /* Override Bootstrap focus state with custom colors */
        .form-control:focus, .form-control:active {
            border-color: #e50914 !important;
            box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25) !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    @include('layout.header')

    <!-- Contact Us Section -->
    <div class="container py-10 md:py-16">
        <div class="contact-section mx-auto max-w-xl bg-white p-6 md:p-10 rounded-xl shadow-2xl border-t-4 border-secondary-red">
            
            <h2 class="text-center text-4xl font-extrabold text-primary-dark mb-2">Hubungi Kami 📧</h2>
            <p class="text-center text-gray-600 mb-8">Kami senang mendengar masukan Anda! Sampaikan pertanyaan, kritik, atau saran Anda melalui formulir di bawah ini.</p>

            <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
                @csrf
                <!-- Your Name -->
                <div class="mb-4">
                    <label for="name" class="form-label block text-sm font-semibold text-gray-700 mb-1">Nama Anda:</label>
                    <input type="text" id="name" name="name" class="form-control w-full p-3 border border-gray-300 rounded-lg shadow-sm" placeholder="Masukkan nama lengkap Anda" required>
                </div>
                
                <!-- Your Email -->
                <div class="mb-4">
                    <label for="email" class="form-label block text-sm font-semibold text-gray-700 mb-1">Email Anda:</label>
                    <input type="email" id="email" name="email" class="form-control w-full p-3 border border-gray-300 rounded-lg shadow-sm" placeholder="Masukkan alamat email Anda" required>
                </div>
                
                <!-- Your Message -->
                <div class="mb-6">
                    <label for="message" class="form-label block text-sm font-semibold text-gray-700 mb-1">Pesan Anda:</label>
                    <textarea id="message" name="message" class="form-control w-full p-3 border border-gray-300 rounded-lg shadow-sm" placeholder="Tuliskan pesan Anda di sini..." rows="6" required></textarea>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn w-full py-3 font-bold text-white rounded-lg shadow-md transition duration-300 
                                             bg-secondary-red hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>

    @include('layout.footer')

    <!-- Menambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
