<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlantFactory extends Factory
{
    public function definition(): array
    {
        [$name, $species] = $this->faker->randomElement([
            ['Monstera', 'Monstera deliciosa'],
            ['Kitchen basil', 'Ocimum basilicum'],
            ['Golden cactus', 'Echinopsis'],
            ['Boston fern', 'Nephrolepis exaltata'],
            ['Snake plant', 'Dracaena trifasciata'],
            ['Aloe vera', 'Aloe barbadensis'],
            ['Pothos', 'Epipremnum aureum'],
            ['Mint', 'Mentha spicata'],
        ]);

        return [
            'name' => $name,
            'species' => $species,
            'room' => $this->faker->randomElement(['Kitchen', 'Bedroom', 'Living room', 'Office']),
            'water_every_days' => $this->faker->numberBetween(2, 14),
            'last_watered_at' => $this->faker->optional()->dateTimeBetween('-20 days'),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }

    public function thirsty(): static
    {
        return $this->state(fn (array $attributes): array => [
            'last_watered_at' => now()->subDays($attributes['water_every_days'] + 2),
        ]);
    }

    public function watered(): static
    {
        return $this->state(fn (array $attributes): array => [
            'last_watered_at' => today(),
        ]);
    }
}
