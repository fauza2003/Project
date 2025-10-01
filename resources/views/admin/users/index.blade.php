<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Accounts</title>

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
                        'admin-blue': '#3b82f6', // Biru untuk indikator Admin
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

        /* Styling kustom untuk tabel */
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
    </style>
</head>

<body>
    <!-- Asumsi Navbar Admin di sini, jika ada -->

    <div class="container mx-auto px-4 py-12 md:py-16">
        <div class="bg-white p-6 md:p-8 rounded-xl shadow-2xl">
            
            <h1 class="text-4xl font-extrabold text-primary-dark mb-2">👥 Kelola Akun Pengguna</h1>
            <p class="text-gray-600 mb-6 border-b pb-4">Lihat daftar lengkap pengguna yang terdaftar di sistem.</p>

            <!-- TABLE CONTAINER (untuk responsivitas) -->
            <div class="overflow-x-auto shadow-md rounded-lg">
                <table class="table table-custom w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left w-1/12">#</th>
                            <th class="px-4 py-3 text-left w-3/12">Nama</th>
                            <th class="px-4 py-3 text-left w-4/12">Email</th>
                            <th class="px-4 py-3 text-center w-2/12">Role</th>
                            <th class="px-4 py-3 text-left w-2/12">Terdaftar Sejak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 font-semibold text-primary-dark">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if ($user->is_admin == 1)
                                        <span class="inline-block bg-admin-blue text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">ADMIN</span>
                                    @else
                                        <span class="inline-block bg-gray-300 text-gray-700 text-xs font-bold px-3 py-1 rounded-full">CUSTOMER</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Back to Dashboard Link -->
            <div class="text-center mt-6">
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
