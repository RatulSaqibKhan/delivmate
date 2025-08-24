<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        return [
            'name' => $this->faker->company . ' Restaurant',
            'user_id' => $user->id,
            'address' => $this->faker->address,
            'lat' => $this->faker->latitude(23.70, 23.90),  // Dhaka area example
            'lng' => $this->faker->longitude(90.30, 90.50),
        ];
    }
}
