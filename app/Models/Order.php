<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'quantity', 'seats'];

    protected $casts = [
        'seats' => 'array', // Mengubah data JSON menjadi array ketika mengambil dari database
    ];
}
