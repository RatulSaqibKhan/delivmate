<?php

namespace Database\Factories;

use App\Models\DeliveryMan;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryAssignmentAttempt>
 */
class DeliveryAssignmentAttemptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::inRandomOrder()->first() ?? Order::factory()->create();
        $deliveryMan = DeliveryMan::inRandomOrder()->first() ?? DeliveryMan::factory()->create();
        return [
            'order_id' => $order->id,
            'delivery_man_id' => $deliveryMan->id,
            'result' => $this->faker->randomElement(['notified', 'accepted', 'rejected', 'timeout']),
            'distance_m' => $this->faker->numberBetween(100, 10000),
        ];
    }
}
