<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GoCinema</title>

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
                    
                    <h1 class="text-3xl font-extrabold text-primary-dark mb-2 text-center">Masuk ke Akun Anda</h1>
                    <p class="text-gray-600 mb-8 text-center border-b pb-4">Selamat datang kembali di GoCinema!</p>

                    <!-- NOTIFIKASI ERROR TAMPIL DI SINI (Memastikan $errors ada) -->
                    @if ($errors->any())
                        @if ($errors->has('email_not_found'))
                            <div class="alert alert-danger bg-red-100 text-red-700 border-red-500 mb-4 rounded-lg p-3" role="alert">
                                **{{ __('Email tidak terdaftar.') }}**
                            </div>
                        @elseif ($errors->has('password_wrong'))
                            <div class="alert alert-danger bg-red-100 text-red-700 border-red-500 mb-4 rounded-lg p-3" role="alert">
                                **{{ __('Password salah.') }}**
                            </div>
                        @else
                            <!-- Tangani error validasi form standar yang tidak spesifik -->
                            <div class="alert alert-danger bg-red-100 text-red-700 border-red-500 mb-4 rounded-lg p-3" role="alert">
                                {{ __('Mohon periksa kembali input Anda.') }}
                            </div>
                        @endif
                    @elseif (session('error'))
                        <!-- Menangani error session umum -->
                        <div class="alert alert-danger bg-red-100 text-red-700 border-red-500 mb-4 rounded-lg p-3" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="email" class="form-label block text-sm font-semibold text-gray-700 mb-1">{{ __('Alamat Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password" class="form-label block text-sm font-semibold text-gray-700 mb-1">{{ __('Kata Sandi') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4 flex justify-between items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-sm text-gray-600" for="remember">
                                    {{ __('Ingat Saya') }}
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button type="submit" class="btn w-full py-3 font-bold text-white rounded-lg shadow-md transition duration-300 
                                                         bg-secondary-red hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300">
                                {{ __('Masuk') }}
                            </button>
                        </div>
                        
                        <!-- Register Link -->
                        <p class="text-center text-gray-600 text-sm">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-primary-dark font-semibold hover:text-secondary-red">
                                Daftar di sini
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
