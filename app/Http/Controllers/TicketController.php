<?php

// app/Http/Controllers/TicketController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function orderForm($movieTitle)
    {
        // Cari movie berdasarkan judul
        $movie = Movie::where('title', urldecode($movieTitle))->firstOrFail();

        return view('order.form', compact('movie'));
    }

    public function order(Request $request, $movieId)
    {
        $request->validate([
            'ticket_count' => 'required|integer|min:1',
        ]);

        $movie = Movie::findOrFail($movieId);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->movie_id = $movie->id;
        $order->ticket_count = $request->ticket_count;
        $order->status = 'pending';
        $order->save();

        return redirect()->route('orders.show', ['orderId' => $order->id])
                         ->with('success', 'Tiket berhasil dipesan!');
    }

    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('order.show', compact('order'));
    }
}
