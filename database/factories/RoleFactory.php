<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\Role;

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
    protected $model = Role::class;

    public function definition()
    {
        $permissions = Permission::pluck('id')->toArray();
        return [
            'name' => $this->faker->unique()->word,
            'permissions' => $this->faker->randomElements($permissions, rand(1, 5)),
        ];
    }
}
