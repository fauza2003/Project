<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSetupController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
// Route untuk halaman utama dengan nama 'home'
Route::get('home', function () {
    return view('home'); // Mengarah ke resources/views/home.blade.php
})->name('home'); // Nama route adalah 'home'

Route::get('/movies', function () {
    return view('movies'); // Mengarah ke resources/views/movies.blade.php
})->name('movies');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create-admin', [AdminSetupController::class, 'createAdmin']);
// routes/web.php


Route::get('/order/{movieTitle}', [TicketController::class, 'orderForm'])->name('order');




Route::post('/order/{movieTitle}', [TicketController::class, 'submitOrder'])->name('order.submit');



Route::get('/order/{orderId}', [TicketController::class, 'show'])->name('order.show');


Route::get('/order/{movieTitle}', [TicketController::class, 'orderForm'])->name('order');
Route::get('/order/{movieTitle}', [TicketController::class, 'orderForm'])->name('order');
// Menampilkan form pemesanan tiket
Route::get('/order/{movieTitle}', [OrderController::class, 'showOrderForm'])->name('order');

// Menangani pengiriman formulir pemesanan tiket
Route::post('/submit-order', [OrderController::class, 'submitOrder'])->name('submitOrder');


// Halaman konfirmasi pemesanan tiket
Route::get('/order-confirmation', [OrderController::class, 'showOrderConfirmation'])->name('orderConfirmation');
Route::get('/order-success', [OrderController::class, 'success'])->name('order.success');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('auth')->group(function () {
    Route::get('user/history', [UserController::class, 'history'])->name('user.history');
    Route::get('user/order/{id}', [UserController::class, 'showOrder'])->name('user.showOrder');
    Route::delete('user/order/{id}/cancel', [UserController::class, 'cancelOrder'])->name('user.cancelOrder');
});
Route::get('/search', [MovieController::class, 'searchMovies'])->name('movies.search');


// Route untuk admin dashboard
Route::get('/admin', [AdminController::class, 'index'])->middleware('isAdmin')->name('admin.dashboard');

// Route untuk form tambah film
Route::get('/admin/movie/create', [AdminController::class, 'create'])->middleware('isAdmin')->name('admin.movie.create');

// Route untuk menyimpan film baru
Route::post('/admin/movie', [AdminController::class, 'store'])->middleware('isAdmin')->name('admin.movie.store');

Route::middleware('auth')->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/movies', [MovieController::class, 'index'])->name('admin.movie.index');
    Route::get('/admin/movies/create', [MovieController::class, 'create'])->name('admin.movie.create');
    Route::post('/admin/movies', [MovieController::class, 'store'])->name('admin.movie.store');
});
Route::get('/admin/movie/success', function() {
    return view('admin.movies.success');
})->name('admin.movie.success');

// Route untuk menampilkan halaman edit movie
Route::get('/admin/movie/{id}/edit', [MovieController::class, 'edit'])->name('admin.movie.edit');

// Route untuk mengupdate data film
Route::put('/admin/movie/{id}', [MovieController::class, 'update'])->name('admin.movie.update');


// Route untuk menghapus film
Route::delete('/admin/movie/{id}', [MovieController::class, 'destroy'])->name('admin.movie.destroy');

Route::get('/movies/search', [MovieController::class, 'searchMovies'])->name('movies.search'); // Search movies

Route::get('/', [MovieController::class, 'showNowShowingMovies']);

Route::get('/admin/movies/success', function () {
    return view('admin.movies.success');
})->name('admin.movies.success');

Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');


