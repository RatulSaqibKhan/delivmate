<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('users')->truncate();
        DB::table('user_roles')->truncate();
        
        DB::table('users')->insert($adminUser);
        DB::table('user_roles')->insert([
            'user_id' => DB::getPdo()->lastInsertId(),
            'role_id' => DB::table('roles')->where('name', 'Admin')->value('id'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
