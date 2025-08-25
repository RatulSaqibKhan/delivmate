<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Abdur Rahman',
                'email' => 'abdur@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801212345678',
                'address' => 'R-14, Banani, Dhaka',
                'lat' => 23.8103,
                'lng' => 90.4125
            ],
            [
                'name' => 'Abdul Hannan',
                'email' => 'abdul@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801212345679',
                'address' => 'R-15, Mirpur, Dhaka',
                'lat' => 23.8104,
                'lng' => 90.4126
            ],
            [
                'name' => 'Marfi Akter',
                'email' => 'marfi@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801212345680',
                'address' => 'R-16, Gulshan, Dhaka',
                'lat' => 23.8105,
                'lng' => 90.4127
            ],
            [
                'name' => 'Sayma Parveen',
                'email' => 'sayma@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801212345681',
                'address' => 'R-17, Dhanmondi, Dhaka',
                'lat' => 23.8106,
                'lng' => 90.4128
            ],
        ];

        $customerRoleId = DB::table('roles')->where('slug', 'customer')->value('id');
        DB::table('customers')->truncate();

        foreach ($customers as $customer) {
            $userId = DB::table('users')->insertGetId([
                'name' => $customer['name'],
                'email' => $customer['email'],
                'password' => $customer['password'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('user_roles')->insert([
                'user_id' => $userId,
                'role_id' => $customerRoleId,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('customers')->insert([
                'user_id' => $userId,
                'phone' => $customer['phone'],
                'address' => $customer['address'],
                'lat' => $customer['lat'],
                'lng' => $customer['lng'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
