<?php

namespace App\Http\Controllers\Api;

//import model Post
use App\Models\Movie;

use Illuminate\Http\Request;

//import resource PostResource
use App\Http\Controllers\Controller;

//import Http request
use App\Http\Resources\MovieResource;
use App\Models\Ticket;
//import facade Validator
use Illuminate\Support\Facades\Validator;

//import facade Storage
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $movies = Movie::all();

        //return collection of posts as a resource
        return new MovieResource(true, 'List Data Film', $movies);
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
            'poster'     => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'description'   => 'required',
            'duration'   => 'required',
            'genre'   => 'required',
            'release_date'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('poster');
        $image->storeAs('public/movies', $image->hashName());

        //create post
        $movie = Movie::create([
            'poster'     => $image->hashName(),
            'title'     => $request->title,
            'description'   => $request->description,
            'duration'   => $request->duration,
            'genre'   => $request->genre,
            'release_date'   => $request->release_date,
        ]);

        //return response
        return new MovieResource(true, 'Data Film Berhasil Ditambahkan!', $movie);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $movie = Movie::find($id);

        //return single post as a resource
        return new MovieResource(true, 'Detail Data Film!', $movie);
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
            'title'     => 'required',
            'description'   => 'required',
            'duration'   => 'required',
            'genre'   => 'required',
            'release_date'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $movie = Movie::find($id);

        //check if image is not empty
        if ($request->hasFile('poster')) {

            //upload image
            $image = $request->file('poster');
            $image->storeAs('public/movies', $image->hashName());

            //delete old image
            Storage::delete('public/movies/' . basename($movie->image));

            //update post with new image
            $movie->update([
                'poster'     => $image->hashName(),
                'title'     => $request->title,
                'description'   => $request->description,
                'duration'   => $request->duration,
                'genre'   => $request->genre,
                'release_date'   => $request->release_date,
            ]);
        } else {

            //update post without image
            $movie->update([
                'title'     => $request->title,
                'description'   => $request->description,
                'duration'   => $request->duration,
                'genre'   => $request->genre,
                'release_date'   => $request->release_date,
            ]);
        }

        //return response   
        return new MovieResource(true, 'Data Film Berhasil Diubah!', $movie);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {

        //find post by ID
        $movie = Movie::find($id);
        //delete post
        $movie->delete();

        //return response
        return new MovieResource(true, 'Data Film Berhasil Dihapus!', null);
    }
    public function success($movie, $seat)
    {
        $movieData = Movie::findOrFail($movie); // Pastikan model Movie ada
        return view('success', compact('movieData', 'seat'));
    }
    // MovieController.php
public function showHome()
{
    // Ambil data film yang sedang tayang
    $movies = Movie::latest()->take(8)->get();  // Mengambil 8 film terbaru

    // Kirim data ke view home
    return view('home', compact('movies'));
}
public function showMovies()
{
    // Ambil data film dari database
    $movies = Movie::all(); // Atau bisa menggunakan query sesuai dengan kebutuhan
    
    // Pass data ke view
    return view('movies.index', compact('movies'));
}


    
}
