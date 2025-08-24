<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\DeliveryMan;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $restaurant = Restaurant::inRandomOrder()->first() ?? Restaurant::factory()->create();
        $customer = Customer::inRandomOrder()->first() ?? Customer::factory()->create();
        $deliveryMan = DeliveryMan::inRandomOrder()->first() ?? DeliveryMan::factory()->create();

        return [
            'restaurant_id' => $restaurant->id,
            'customer_id' => $customer->id,
            'delivery_address' => $customer->address,
            'lat' => $customer->lat,
            'lng' => $customer->lng,
            'status' => $this->faker->randomElement(['pending', 'assigned', 'accepted', 'rejected', 'on_the_way', 'delivered', 'canceled']),
            'delivery_man_id' => $deliveryMan->id,
            'assignment_expires_at' => $this->faker->dateTimeBetween('now', '+1 hour'),
        ];
    }
}
