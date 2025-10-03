<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan dashboard admin
    public function index()
    {
        return view('admin.dashboard');
    }

    // Menampilkan form tambah film
    public function create()
    {
        return view('admin.movie.create');
    }

    // Menyimpan film baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string','string',
        'min:20',
        'regex:/[a-zA-Z0-9]{3,}/',
            'image_url' => 'required|url',
        ]);

        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->image_url = $request->input('image_url');
        $movie->save();

        return redirect()->route('admin.dashboard')->with('success', 'Movie added successfully!');
    }
}
