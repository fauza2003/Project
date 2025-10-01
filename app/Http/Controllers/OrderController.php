<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Harga per tiket tetap Rp 50.000 sesuai asumsi
    private const TICKET_PRICE = 50000;
    
    public function showOrderForm($movieTitle)
    {
        return view('order.blade.php', ['movieTitle' => $movieTitle]);
    }

    public function submitOrder(Request $request)
    {
        // 1. Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1',
            // Perbaikan: Menerima string yang dipisahkan koma dari JS
            'seats' => 'required|string', 
            'movie_title' => 'required|string|max:255',
        ]);

        // 2. Proses data kursi (dari string menjadi array)
        // String "A1,B2,C3" diubah menjadi array ['A1', 'B2', 'C3']
        $seatsArray = explode(',', $validatedData['seats']);
        
        // 3. Hitung total harga
        $totalPrice = $validatedData['quantity'] * self::TICKET_PRICE;


        // 4. Simpan data pesanan
        $order = new Order();
        $order->name = $validatedData['name'];
        $order->email = $validatedData['email'];
        $order->quantity = $validatedData['quantity'];
        
        // Simpan array kursi dalam format JSON
        $order->seats = json_encode($seatsArray); 
        
        $order->movie_title = $validatedData['movie_title']; 
        $order->total_price = $totalPrice; // Tambahkan total harga (asumsi ada di tabel order)
        
        $order->save();
        

        // 5. Redirect atau tampilkan pesan sukses
        // Catatan: Jika Anda tidak mengirim objek $order ke view success, Anda tidak perlu mengirimnya di sini.
        return redirect()->route('order.success')->with('success', 'Tiket berhasil dipesan!');
    }
    
    public function success()
    {
        return view('order.success');
    }
    
    // Asumsi fungsi-fungsi lain (show, cancel) ada di OrderController atau UserController
}
