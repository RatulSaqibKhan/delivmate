<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $role = $this->faker->randomElement(['Admin', 'Restaurant', 'Customer', 'Delivery Man']);
        $slug = strtolower(str_replace(' ', '_', $role));
        
        return [
            'name' => $role,
            'slug' => $slug,
        ];
    }
}
