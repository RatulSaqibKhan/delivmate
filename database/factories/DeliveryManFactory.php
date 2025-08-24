<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryMan>
 */
class DeliveryManFactory extends Factory
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
            'name' => $this->faker->name,
            'user_id' => $user->id,
            'phone' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement(['offline','available','reserved','busy']),
            'lat' => $this->faker->latitude(23.70, 23.90),
            'lng' => $this->faker->longitude(90.30, 90.50),
            'last_seen_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
