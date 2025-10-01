<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - GoCinema</title>

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
                        'success-green': '#198754', 
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

        .verify-card {
            border-top: 5px solid #e50914; /* Aksen Merah */
            border-radius: 1rem;
        }
        
        .btn-link-custom {
            color: #e50914;
            font-weight: 600;
            text-decoration: underline;
        }
        .btn-link-custom:hover {
            color: #b30710;
        }
    </style>
</head>

<body>
<div class="container mx-auto px-4 py-12 md:py-20">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="verify-card bg-white p-8 md:p-10 shadow-2xl">
                
                <h1 class="text-3xl font-extrabold text-primary-dark mb-4 text-center border-b pb-3">
                    Verifikasi Alamat Email Anda
                </h1>

                <!-- Body Konten -->
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success bg-green-100 text-success-green border-success-green p-4 rounded-lg mb-4" role="alert">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </div>
                    @endif

                    <p class="text-gray-700 mb-4">
                        {{ __('Sebelum melanjutkan, mohon periksa email Anda untuk tautan verifikasi.') }}
                    </p>
                    
                    <p class="text-gray-700 mb-4">
                        {{ __('Jika Anda tidak menerima email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline btn-link-custom">
                                {{ __('klik di sini untuk meminta yang lain') }}
                            </button>.
                        </form>
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan script Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
@endsection
