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
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (config('app.env') == "local") {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            // Roles
            $this->call(RoleSeeder::class);
            // Admin User
            $this->call(UserSeeder::class);
            // Customers
            $this->call(CustomerSeeder::class);

            // Delivery Men
            $this->call(DeliveryManSeeder::class);

            // Restaurants
            $this->call(RestaurantSeeder::class);

            // Orders
            Order::factory(50)->create()->each(function ($order) {
                // Assignment attempts for each order
                DeliveryAssignmentAttempt::factory(2)->create(['order_id' => $order->id]);
            });

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
