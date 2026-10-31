<?php

namespace Database\Factories;

use App\Enums\PlaceKind;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kind = fake()->randomElement(PlaceKind::cases());

        return [
            'name' => match ($kind) {
                PlaceKind::Hall => 'Hall '.fake()->randomElement(['des guichets', 'principal', 'sud']),
                PlaceKind::Platform => 'Quai '.fake()->numberBetween(1, 8),
                PlaceKind::Train => 'IC '.fake()->city().' – '.fake()->city(),
            },
            'kind' => $kind,
        ];
    }
}
