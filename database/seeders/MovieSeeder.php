<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie; // Pastikan Model Movie diimport

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan data film ke database
        Movie::create([
            'title' => 'Bila Esok Ibu Tiada',
            'description' => 'Film drama penuh haru tentang kasih ibu.',
            'duration' => '120',
            'genre' => 'Drama',
            'release_date' => '2023-01-01',
            'poster' => 'bilaibutiada.webp',
        ]);

        Movie::create([
            'title' => 'Santet Segoro Pitu',
            'description' => 'Horor mistis yang mengungkap rahasia kegelapan.',
            'duration' => '110',
            'genre' => 'Horor',
            'release_date' => '2023-02-15',
            'poster' => 'santetsegoropitu.webp',
        ]);

        Movie::create([
            'title' => 'Petak Umpet',
            'description' => 'Thriller tentang permainan petak umpet yang mematikan.',
            'duration' => '100',
            'genre' => 'Thriller',
            'release_date' => '2023-03-10',
            'poster' => 'petakumpet.webp',
        ]);

        Movie::create([
            'title' => 'Wicked',
            'description' => 'Film fantasi tentang penyihir di dunia magis.',
            'duration' => '130',
            'genre' => 'Fantasi',
            'release_date' => '2023-04-20',
            'poster' => 'wicked.webp',
        ]);

        Movie::create([
            'title' => 'Venom: The Last Dance',
            'description' => 'Aksi penuh petualangan dari karakter anti-hero.',
            'duration' => '125',
            'genre' => 'Aksi',
            'release_date' => '2023-05-01',
            'poster' => 'venom.jpg',
        ]);
    }
}
