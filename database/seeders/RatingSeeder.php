<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::create([
            'user_id' => 1, // Asume que el usuario Admin tiene el ID 1 en la tabla de usuarios
            'episode_id' => 1, // Asume que el episodio 1 tiene el ID 1 en la tabla de episodios
            'rating' => 4,
        ]);
    }
}
