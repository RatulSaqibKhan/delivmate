<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'Restaurant', 'Delivery Man', 'Customer'];

        DB::table('roles')->truncate();
        DB::table('roles')->insert(array_map(fn($role) => [
            'name' => $role, 
            'slug' => strtolower(str_replace(' ', '-', $role)), 
            'created_at' => now(), 
            'updated_at' => now()
        ], $roles));
    }
}
