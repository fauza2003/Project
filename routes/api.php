<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Movie;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('/tickets', App\Http\Controllers\Api\TicketController::class);
Route::apiResource('/movies', App\Http\Controllers\Api\MovieController::class);

Route::get('/movies', function () {
    return Movie::all();
});