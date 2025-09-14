<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actions = ['view', 'create', 'update', 'delete'];
        $resources = ['users', 'roles', 'permissions', 'bootcamps', 'batches', 'enrollments', 'orders', 'certificates', 'vouchers'];
        
        $action = fake()->randomElement($actions);
        $resource = fake()->randomElement($resources);
        
        return [
            'name' => $action . ' ' . $resource,
            'guard_name' => 'web',
        ];
    }
}