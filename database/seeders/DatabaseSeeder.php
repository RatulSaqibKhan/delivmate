<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\DeliveryAssignmentAttempt;
use App\Models\DeliveryMan;
use App\Models\DeliveryZone;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory(4)->create();
        User::factory(10)->create();

         // Customers
        Customer::factory(20)->create();

        // Delivery Men
        DeliveryMan::factory(15)->create();

        // Restaurants
        Restaurant::factory(25)->create()->each(function ($restaurant) {
            DeliveryZone::factory(2)->create(['restaurant_id' => $restaurant->id]);
        });

        // Orders
        Order::factory(50)->create()->each(function ($order) {
            // Assignment attempts for each order
            DeliveryAssignmentAttempt::factory(2)->create(['order_id' => $order->id]);
        });

        UserRole::factory(30)->create();
    }
}
