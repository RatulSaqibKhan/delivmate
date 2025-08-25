<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryManSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deliveryMen = [
            [
                'name' => 'Hasan Rahman',
                'email' => 'hasan@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801112345678',
                'lat' => 23.8103,
                'lng' => 90.4125,
                'status' => 'available'
            ],
            [
                'name' => 'Mamun Hannan',
                'email' => 'mamun@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801112345679',
                'lat' => 23.8104,
                'lng' => 90.4126,
                'status' => 'available'
            ],
            [
                'name' => 'Shampa Akter',
                'email' => 'shampa@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801112345680',
                'lat' => 23.8105,
                'lng' => 90.4127,
                'status' => 'available'
            ],
            [
                'name' => 'Masuda Parveen',
                'email' => 'masuda@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801112345681',
                'lat' => 23.8106,
                'lng' => 90.4128,
                'status' => 'available'
            ],
        ];

        $roleId = DB::table('roles')->where('slug', 'delivery-man')->value('id');
        DB::table('delivery_men')->truncate();

        foreach ($deliveryMen as $deliveryMan) {
            $userId = DB::table('users')->insertGetId([
                'name' => $deliveryMan['name'],
                'email' => $deliveryMan['email'],
                'password' => $deliveryMan['password'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('user_roles')->insert([
                'user_id' => $userId,
                'role_id' => $roleId,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('delivery_men')->insert([
                'user_id' => $userId,
                'phone' => $deliveryMan['phone'],
                'lat' => $deliveryMan['lat'],
                'lng' => $deliveryMan['lng'],
                'status' => $deliveryMan['status'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
