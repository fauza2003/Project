<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // Menampilkan riwayat pesanan berdasarkan email pengguna yang sedang login
    public function history()
    {
        // Mengambil semua pesanan dari pengguna yang sedang login berdasarkan email
        $orders = Order::where('email', Auth::user()->email)->get();

        return view('user.history', compact('orders'));
    }

    // Menampilkan detail pesanan berdasarkan email pengguna yang sedang login
    public function showOrder($id)
    {
        // Mengambil data pesanan berdasarkan ID
        $order = Order::find($id);
    
        // Cek apakah pesanan ditemukan
        if (!$order) {
            return redirect()->route('user.history')->with('error', 'Pesanan tidak ditemukan.');
        }
    
        // Cek apakah pesanan milik pengguna yang sedang login
        if ($order->email != Auth::user()->email) {
            return redirect()->route('user.history')->with('error', 'Akses tidak sah.');
        }
    
        // Jika ditemukan, lanjutkan untuk menampilkan detail
        return view('user.orderDetail', compact('order'));
    }
    

    // Membatalkan pesanan berdasarkan email pengguna yang sedang login
    public function cancelOrder($id)
    {
        // Mengambil data pesanan berdasarkan ID dan memastikan pengguna yang login adalah pemilik pesanan berdasarkan email
        $order = Order::find($id);

        // Cek apakah pesanan ditemukan dan apakah milik pengguna yang sedang login
        if (!$order) {
            return redirect()->route('user.history')->with('error', 'Pesanan tidak ditemukan.');
        }

        if ($order->email != Auth::user()->email) {
            return redirect()->route('user.history')->with('error', 'Akses tidak sah.');
        }

        // Membatalkan pesanan
        if ($order->status == 'cancelled') {
            return redirect()->route('user.history')->with('error', 'Pesanan sudah dibatalkan.');
        }

        $order->status = 'cancelled'; // Menandakan pesanan dibatalkan
        $order->save();

        return redirect()->route('user.history')->with('success', 'Pesanan berhasil dibatalkan!');
    }
    public function index()
    {
        // Ambil semua pengguna yang bukan admin (is_admin != 1)
        $users = User::where('is_admin', '!=', 1)->get();
    
        // Kirim data ke view
        return view('admin.users.index', compact('users'));
    }
}
