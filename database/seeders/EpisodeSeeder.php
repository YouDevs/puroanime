<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('episodes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \App\Models\Episode::factory(50)->create();

        // Episode::create([
        //     'anime_id' => 1, // Asume que Naruto tiene el ID 1 en la tabla de animes
        //     'title' => 'Episodio 1',
        //     'episode_number' => 1,
        //     'summary' => null,
        //     'air_date' => '2002-10-03',
        //     'type' => 'canon',
        // ]);
    }
}
