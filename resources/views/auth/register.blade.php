<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - GoCinema</title>

    <!-- Menambahkan link Bootstrap CSS (untuk spinner dan grid) -->
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

        .login-card {
            border-top: 5px solid #e50914; /* Aksen Merah */
            border-radius: 1rem;
        }
        
        /* Override Bootstrap focus state with custom colors */
        .form-control:focus, .form-control:active {
            border-color: #e50914 !important;
            box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25) !important;
        }
        .form-control {
            padding: 0.75rem;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-12 md:py-20">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-card bg-white p-8 md:p-10 shadow-2xl">
                    
                    <h1 class="text-3xl font-extrabold text-primary-dark mb-2 text-center">Buat Akun Baru</h1>
                    <p class="text-gray-600 mb-8 text-center border-b pb-4">Daftar untuk mulai memesan tiket!</p>
                    
                    <!-- Form dengan ID untuk JavaScript Handling -->
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name Input -->
                        <div class="mb-4">
                            <label for="name" class="form-label block text-sm font-semibold text-gray-700 mb-1">{{ __('Nama') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="email" class="form-label block text-sm font-semibold text-gray-700 mb-1">{{ __('Alamat Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password" class="form-label block text-sm font-semibold text-gray-700 mb-1">{{ __('Kata Sandi') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <!-- Confirm Password Input -->
                        <div class="mb-6">
                            <label for="password-confirm" class="form-label block text-sm font-semibold text-gray-700 mb-1">{{ __('Konfirmasi Kata Sandi') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>


                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button id="registerButton" type="submit" class="btn w-full py-3 font-bold text-white rounded-lg shadow-md transition duration-300 
                                                                             bg-secondary-red hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300">
                                {{ __('Daftar') }}
                            </button>
                        </div>
                        
                        <!-- Login Link -->
                        <p class="text-center text-gray-600 text-sm">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-primary-dark font-semibold hover:text-secondary-red">
                                Masuk di sini
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan script Bootstrap JS (untuk spinner) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function() {
            const button = document.getElementById('registerButton');
            
            // 1. Nonaktifkan tombol
            button.disabled = true;
            
            // 2. Ubah tampilan menjadi loading state
            button.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Memproses...
            `;
            
            // Opsi: Tambahkan class untuk tampilan yang lebih gelap saat loading
            button.classList.add('opacity-75');
        });
    </script>
</body>

</html>
