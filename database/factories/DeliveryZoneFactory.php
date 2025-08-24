<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryZone>
 */
class DeliveryZoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $restaurant = Restaurant::inRandomOrder()->first() ?? Restaurant::factory()->create();

        $type = $this->faker->randomElement(['polygon', 'radius']);

        return [
            'restaurant_id' => $restaurant->id,
            'type' => $type,
            'geojson' => $type === 'polygon'
                ? json_encode([
                    [$restaurant->longitude, $restaurant->latitude],
                    [$restaurant->longitude + 0.01, $restaurant->latitude + 0.01],
                    [$restaurant->longitude + 0.02, $restaurant->latitude]
                ])
                : null,
            'radius_m' => $type === 'radius' ? $this->faker->numberBetween(1000, 5000) : null, // meters
            'center_lat' => $type === 'radius' ? $restaurant->latitude : null,
            'center_lng' => $type === 'radius' ? $restaurant->longitude : null,
        ];
    }
}
