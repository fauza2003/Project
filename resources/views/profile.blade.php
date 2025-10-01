<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - GoCinema</title>

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
        .profile-container {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .profile-info strong {
            color: #1a1a1a;
            font-weight: 700;
        }
        .profile-info span {
            color: #555;
            font-weight: 500;
        }
        .logout-btn {
            background-color: #e50914;
            border-color: #e50914;
            transition: background-color 0.2s;
        }
        .logout-btn:hover {
            background-color: #b30710;
            border-color: #b30710;
        }
    </style>
</head>

<body>
    @include('layout.header')

    <!-- Profile Section -->
    <main>
        <section id="profile" class="py-12 md:py-20">
            <div class="container mx-auto px-4">
                <div class="profile-container p-6 md:p-10 max-w-2xl mx-auto">
                    
                    <div class="profile-header text-center border-b pb-4 mb-6">
                        <h2 class="text-4xl font-extrabold text-primary-dark">👤 Profil Pengguna</h2>
                        <p class="text-gray-600 mt-2">Kelola informasi akun Anda di sini.</p>
                    </div>

                    @if(Auth::check())
                    <div class="profile-content">
                        <!-- Kartu Informasi -->
                        <div class="profile-info space-y-4 mb-8">
                            
                            <div class="profile-detail p-3 border-l-4 border-secondary-red bg-gray-50 rounded-md shadow-sm">
                                <p class="mb-0 text-lg">
                                    <strong>Nama:</strong> <span class="ml-2">{{ Auth::user()->name }}</span>
                                </p>
                            </div>
                            
                            <div class="profile-detail p-3 border-l-4 border-secondary-red bg-gray-50 rounded-md shadow-sm">
                                <p class="mb-0 text-lg">
                                    <strong>Email:</strong> <span class="ml-2">{{ Auth::user()->email }}</span>
                                </p>
                            </div>
                            
                            <div class="profile-detail p-3 border-l-4 border-secondary-red bg-gray-50 rounded-md shadow-sm">
                                <p class="mb-0 text-lg">
                                    <strong>Member Sejak:</strong> <span class="ml-2">{{ Auth::user()->created_at->format('d M Y') }}</span>
                                </p>
                            </div>

                            <!-- Anda bisa menambahkan informasi lain di sini, seperti Level Membership -->
                            <div class="profile-detail p-3 border-l-4 border-accent-gold bg-yellow-50 rounded-md shadow-sm">
                                <p class="mb-0 text-lg">
                                    <strong>Role:</strong> <span class="ml-2 font-bold text-accent-gold">{{ Auth::user()->is_admin == 1 ? 'ADMINISTRATOR' : 'CUSTOMER' }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Bagian Logout -->
                        <div class="logout-section mt-8">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="logout-btn btn btn-danger w-full py-3 font-bold" type="submit">
                                    Keluar (Logout)
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="not-logged-in text-center p-8 bg-gray-100 rounded-lg">
                        <p class="text-lg mb-4">Anda belum login. Silakan masuk untuk melihat profil Anda.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary bg-secondary-red hover:bg-red-700 border-none font-bold">
                            Login di sini
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

    @include('layout.footer')

    <!-- Tambahkan script Bootstrap JS di bagian bawah body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
