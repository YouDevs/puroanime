<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anime;

class AnimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Anime::create([
            'title' => 'Demon Slayer',
            'description' => 'Kimetzu no Yaiba es una serie de anime basada en el manga del mismo nombre...',
            'cover_image' => 'path/to/cover/image',
            'thumbnail_image' => 'path/to/thumbnail/image',
            'streaming_platforms' => json_encode(['Netflix', 'Crunchyroll']),
        ]);
        // Anime::create([
        //     'title' => 'Naruto',
        //     'description' => 'Naruto es una serie de anime basada en el manga del mismo nombre...',
        //     'cover_image' => 'path/to/cover/image',
        //     'thumbnail_image' => 'path/to/thumbnail/image',
        //     'streaming_platforms' => json_encode(['Netflix', 'Crunchyroll']),
        // ]);

        // Agregar más animes aquí
    }
}
