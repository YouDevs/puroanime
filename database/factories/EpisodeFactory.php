<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Episode>
 */
class EpisodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'anime_id' => rand(1, 2),
            'title' => $this->faker->sentence(2),
            'episode_number' => rand(1, 100),
            'summary' => $this->faker->text(255),
            'air_date' => $this->faker->dateTimeBetween('-10 year', '-1 year'),
            'type' => $this->faker->randomElement(['canon', 'filler', 'mixed'])
        ];
    }
}
