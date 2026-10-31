<?php

namespace Database\Factories;

use App\Enums\Color;
use App\Models\Item;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'place_id' => Place::factory(),
            'name' => ucfirst(fake()->words(fake()->numberBetween(1, 3), true)),
            'description' => fake()->optional()->sentence(12),
            'color' => fake()->randomElement(Color::cases()),
            'found_on' => fake()->dateTimeBetween('-1 month', 'today')->format('Y-m-d'),
            'returned_at' => null,
        ];
    }

    /**
     * Indicate that the item has been returned to its owner.
     */
    public function returned(): static
    {
        return $this->state(fn (array $attributes) => [
            'returned_at' => today(),
        ]);
    }
}
