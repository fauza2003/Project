<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Email tidak ditemukan di database
            return redirect()->route('login')->withErrors(['email_not_found' => 'Email address not registered.']);
        }
        
        // Cek apakah password cocok
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            // Login berhasil
            return redirect()->route('profile');
        } else {
            // Email ditemukan, tapi password salah
            return redirect()->route('login')->withErrors(['password_wrong' => 'Incorrect password.']);
        }
    }

    // Menangani proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Asumsi is_admin adalah 0 (default user)
            'is_admin' => 0, 
        ]);

        Auth::login($user);

        return redirect()->route('profile');
    }

    // Menampilkan halaman profil
    public function showProfile()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('profile');
    }
}
