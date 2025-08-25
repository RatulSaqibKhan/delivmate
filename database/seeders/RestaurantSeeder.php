<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = [
            [
                'name' => 'Tri Star Top',
                'email' => 'tst@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801512345678',
                'address' => 'H-19, R-14, Banani, Dhaka',
                'lat' => 23.8103,
                'lng' => 90.4125,
                'delivery_zone_type' => 'polygon',
                'delivery_zone_geojson' => '{"type":"Polygon","coordinates":[[[90.4125,23.8103],[90.4126,23.8103],[90.4126,23.8104],[90.4125,23.8104],[90.4125,23.8103]]]}',
                'delivery_zone_center_lat' => 23.81035,
                'delivery_zone_center_lng' => 90.41255,
                'delivery_zone_radius_m' => null
            ],
            [
                'name' => 'Lahore Kabab Express',
                'email' => 'lke@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801512345679',
                'address' => 'H-21, R-15, Mirpur, Dhaka',
                'lat' => 23.8104,
                'lng' => 90.4126,
                'delivery_zone_type' => 'polygon',
                'delivery_zone_geojson' => '{"type":"Polygon","coordinates":[[[90.4126,23.8104],[90.4127,23.8104],[90.4127,23.8105],[90.4126,23.8105],[90.4126,23.8104]]]}',
                'delivery_zone_center_lat' => 23.81045,
                'delivery_zone_center_lng' => 90.41265,
                'delivery_zone_radius_m' => null
            ],
            [
                'name' => 'Kachchi Bhai',
                'email' => 'kchb@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801512345680',
                'address' => 'H-23, R-16, Gulshan, Dhaka',
                'lat' => 23.8105,
                'lng' => 90.4127,
                'delivery_zone_type' => 'radius',
                'delivery_zone_geojson' => '{"type":"Point","coordinates":[90.4127,23.8105]}',
                'delivery_zone_center_lat' => 23.81055,
                'delivery_zone_center_lng' => 90.41275,
                'delivery_zone_radius_m' => 100
            ],
            [
                'name' => 'Dominos',
                'email' => 'dominos@example.com',
                'password' => bcrypt('password'),
                'phone' => '8801512345681',
                'address' => 'H-26, R-17, Dhanmondi, Dhaka',
                'lat' => 23.8106,
                'lng' => 90.4128,
                'delivery_zone_type' => 'radius',
                'delivery_zone_geojson' => '{"type":"Point","coordinates":[90.4128,23.8106]}',
                'delivery_zone_center_lat' => 23.81065,
                'delivery_zone_center_lng' => 90.41285,
                'delivery_zone_radius_m' => 100
            ],
        ];

        $roleId = DB::table('roles')->where('slug', 'restaurant')->value('id');
        DB::table('restaurants')->truncate();
        DB::table('delivery_zones')->truncate();

        foreach ($restaurants as $restaurant) {
            $userId = DB::table('users')->insertGetId([
                'name' => $restaurant['name'],
                'email' => $restaurant['email'],
                'password' => $restaurant['password'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('user_roles')->insert([
                'user_id' => $userId,
                'role_id' => $roleId,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $restaurantId = DB::table('restaurants')->insertGetId([
                'user_id' => $userId,
                'phone' => $restaurant['phone'],
                'address' => $restaurant['address'],
                'lat' => $restaurant['lat'],
                'lng' => $restaurant['lng'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('delivery_zones')->insert([
                'restaurant_id' => $restaurantId,
                'type' => $restaurant['delivery_zone_type'],
                'geojson' => $restaurant['delivery_zone_geojson'],
                'center_lat' => $restaurant['delivery_zone_center_lat'],
                'center_lng' => $restaurant['delivery_zone_center_lng'],
                'radius_m' => $restaurant['delivery_zone_radius_m'] ?? null,
                'bbox_min_lat' => null,
                'bbox_min_lng' => null,
                'bbox_max_lat' => null,
                'bbox_max_lng' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
