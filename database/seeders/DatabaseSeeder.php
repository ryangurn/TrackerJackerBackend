<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Round;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $competitions = Competition::factory(5)->create();
        foreach ($competitions as $number => $competition) {
            Round::factory(fake()->numberBetween(3, 6))->create(['competition_id' => $competition->id]);
        }
    }
}
