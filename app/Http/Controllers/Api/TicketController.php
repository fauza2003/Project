<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use App\Models\Order; // Pastikan Order di-import
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Pastikan Auth di-import

class TicketController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all tickets
        $tickets = Ticket::latest()->paginate(5);

        //return collection of tickets as a resource
        return new TicketResource(true, 'List Data Tiket', $tickets);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'movie'     => 'required',
            'cinema'     => 'required',
            'date'   => 'required',
            'time'     => 'required',
            'seat'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create ticket
        $ticket = Ticket::create([
            'movie'     => $request->movie,
            'cinema'     => $request->cinema,
            'date'   => $request->date,
            'time'     => $request->time,
            'seat'     => $request->seat,
        ]);

        //return response
        return new TicketResource(true, 'Data Tiket Berhasil Ditambahkan!', $ticket);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find ticket by ID
        $ticket = Ticket::find($id);

        //return single ticket as a resource
        return new TicketResource(true, 'Detail Data Tiket!', $ticket);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'movie'     => 'required',
            'cinema'     => 'required',
            'date'   => 'required',
            'time'     => 'required',
            'seat'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find ticket by ID
        $ticket = Ticket::find($id);

        //update ticket without image
        $ticket->update([
            'movie'     => $request->movie,
            'cinema'     => $request->cinema,
            'date'   => $request->date,
            'time'     => $request->time,
            'seat'     => $request->seat,
        ]);

        //return response
        return new TicketResource(true, 'Data Tiket Berhasil Diubah!', $ticket);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find ticket by ID
        $ticket = Ticket::find($id);
        //delete ticket
        $ticket->delete();

        //return response
        return new TicketResource(true, 'Data Tiket Berhasil Dihapus!', null);
    }

    /**
     * Process order and store selected seats
     *
     * @param  mixed $request
     * @param  mixed $movie
     * @return void
     */
    public function processOrder(Request $request, $movie)
{
    // Ambil kursi yang dipilih dari form
    $seats = $request->input('seats');

    // Simpan pemesanan ke database
    $order = new Order();
    $order->user_id = Auth::id(); // ID pengguna yang login
    $order->seats = $seats; // Kursi yang dipilih
    $order->save();

    // Redirect ke halaman sukses dengan pesan
    return redirect()->route('orderSuccess')->with('message', 'Tiket berhasil dipesan!');
}

    /**
     * Display available seats for the movie
     *
     * @param  mixed $movie
     * @return void
     */
    public function selectSeat($movie)
    {
        // Simulasi data kursi bioskop
        $seats = [
            ['id' => 'A1', 'label' => 'A1', 'available' => true],
            ['id' => 'A2', 'label' => 'A2', 'available' => true],
            ['id' => 'A3', 'label' => 'A3', 'available' => false],
            ['id' => 'A4', 'label' => 'A4', 'available' => true],
            ['id' => 'B1', 'label' => 'B1', 'available' => true],
            ['id' => 'B2', 'label' => 'B2', 'available' => false],
            ['id' => 'B3', 'label' => 'B3', 'available' => true],
            ['id' => 'B4', 'label' => 'B4', 'available' => true],
            // Tambahkan lebih banyak kursi sesuai kebutuhan
        ];

        // Pisahkan kursi berdasarkan baris
        $rows = collect($seats)->chunk(4)->toArray();

        return view('select_seat', ['movie' => $movie, 'seats' => $rows]);
    }

    /**
     * Confirm selected seats for booking
     *
     * @param  mixed $request
     * @return void
     */
    public function confirmSeat(Request $request)
    {
        $selectedSeats = $request->input('seats', []);

        if (empty($selectedSeats)) {
            return redirect()->back()->with('error', 'Silakan pilih setidaknya satu kursi.');
        }

        // Proses pemesanan kursi (simpan ke database atau lainnya)
        // Contoh:
        // Reservation::create(['seats' => json_encode($selectedSeats), 'user_id' => auth()->id()]);

        return redirect()->route('home')->with('success', 'Kursi berhasil dipesan: ' . implode(', ', $selectedSeats));
    }

    
}
