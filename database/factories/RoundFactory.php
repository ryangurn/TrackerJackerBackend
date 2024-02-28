<?php

namespace Database\Factories;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Round>
 */
class RoundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'competition_id' => Competition::factory(),
            'number' => fake()->randomNumber(),
            'level' => '',
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'active_override' => fake()->boolean(1)
        ];
    }
}
