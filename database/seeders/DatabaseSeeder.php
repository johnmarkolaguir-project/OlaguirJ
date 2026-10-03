<?php

namespace Database\Seeders;

use App\Models\Plant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Plant::factory(8)->create();

        Plant::factory()->thirsty()->create([
            'name' => 'Kitchen basil',
            'species' => 'Ocimum basilicum',
            'room' => 'Kitchen',
            'water_every_days' => 2,
            'notes' => 'Pinch the tops often so it stays bushy.',
        ]);

        Plant::factory()->watered()->create([
            'name' => 'Desk fern',
            'species' => 'Nephrolepis exaltata',
            'room' => 'Office',
            'water_every_days' => 3,
            'notes' => 'Loves humidity, hates direct sun.',
        ]);
    }
}
