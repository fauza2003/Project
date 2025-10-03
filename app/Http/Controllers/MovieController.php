<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Wajib: Import Storage facade untuk menangani file

class MovieController extends Controller
{
    // Ambil semua data film untuk dashboard admin
    public function index($isAdmin = false)
    {
        $movies = Movie::all();
    
        if ($isAdmin) {
            return view('admin.movies.index', compact('movies'));
        }
    
        // Memastikan variabel $movies dikirimkan
        return view('admin.movies.index', ['movies' => $movies]);
    }
    
    // Menampilkan form untuk menambah movie
    public function create()
    {
        return view('admin.movies.create');
    }

    // Menyimpan data movie baru ke dalam database
    public function store(Request $request)
    {
        // 1. Validasi Input dan File (Sesuai skema database: duration=integer, genre=enum, poster=file)
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|',
    'string',
    'min:20',
    'regex:/[a-zA-Z0-9]/', 
            'genre' => 'required|in:fiksi,nonfiksi,misteri,fantasi,romansa,sains', // Sesuai ENUM
            'release_date' => 'required|date',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuai File Upload
        ]);

        $posterPath = null;

        // 2. Proses File Upload
        if ($request->hasFile('poster')) {
            // Simpan file ke storage/app/public/posters
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        // 3. Menyimpan data movie ke dalam database
        $movie = Movie::create(array_merge($validatedData, [
            'poster' => $posterPath, // Simpan path storage
        ])); 

        // Redirect ke halaman daftar movie
        return redirect()->route('admin.movie.index')->with('success', 'Movie added successfully!');
    }


    // Menampilkan detail movie berdasarkan ID
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    // Menampilkan form untuk mengedit data movie
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

    // Memperbarui data movie (Sudah diperbaiki untuk File Upload dan ENUM)
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
    
        // 1. Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        'string',
        'min:20',
        'regex:/[a-zA-Z0-9]{3,}/',
            'duration' => 'required|integer|min:1',
            'genre' => 'required|in:fiksi,nonfiksi,misteri,fantasi,romansa,sains', // Sesuai ENUM
            'release_date' => 'required|date',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opsional saat Update
        ]);

        $posterPath = $movie->poster; 
        
        // 2. Cek jika ada file poster baru yang diupload
        if ($request->hasFile('poster')) {
            // Hapus poster lama dari storage
            if ($movie->poster) {
                Storage::disk('public')->delete($movie->poster);
            }
            // Simpan poster baru
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        // 3. Update film
        $movie->update(array_merge($validated, ['poster' => $posterPath]));
    
        // Redirect
        return redirect()->route('admin.movie.index')->with('success', 'Movie updated successfully!');
    }

    // Menghapus data movie (Sudah diperbaiki untuk menghapus file dari storage)
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        
        // Hapus file poster dari storage sebelum menghapus record database
        if ($movie->poster) {
            Storage::disk('public')->delete($movie->poster);
        }
        
        // Menghapus film dari database
        $movie->delete();
        
        // Redirect
        return redirect()->route('admin.movie.index')->with('success', 'Movie deleted successfully!');
    }

    /**
     * Menangani Tampilan Home dan Pencarian Film (Logic digabungkan)
     */
    public function showNowShowingMovies(Request $request)
    {
        $searchTerm = $request->input('search'); 
        
        // Mulai query
        $query = Movie::query();
        
        // Jika ada kata kunci pencarian, terapkan filter
        if ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }

        // Ambil hasil filter (atau semua film jika tidak ada pencarian)
        $movies = $query->get();
    
        // Kirim data film yang sudah difilter ke view home (atau movies_list_grid)
        return view('home', compact('movies'));
    }
    
    /**
     * Route untuk searchMovies dipanggil ke showNowShowingMovies (di web.php)
     */
    public function searchMovies(Request $request)
    {
        // Panggil fungsi utama agar logic pencarian hanya ada di satu tempat
        return $this->showNowShowingMovies($request);
    }
}
