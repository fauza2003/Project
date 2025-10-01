<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul film
            $table->text('description')->nullable(); // Deskripsi film
            $table->unsignedSmallInteger('duration'); // Durasi film dalam menit (diubah ke integer)
            
            // --- Perubahan untuk Genre (Dropdown) ---
            $table->enum('genre', [
                'fiksi', 
                'nonfiksi', 
                'misteri', 
                'fantasi', 
                'romansa', 
                'sains'
            ]); // Genre film (Menggunakan ENUM untuk konsistensi data)
            
            $table->date('release_date'); // Tanggal rilis film
            
            // --- Perubahan untuk Poster (Upload File) ---
            // Tipe data tetap STRING (untuk menyimpan path/URL)
            $table->string('poster')->nullable(); // Path/URL poster film
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};