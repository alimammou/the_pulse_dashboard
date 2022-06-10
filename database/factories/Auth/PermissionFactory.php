<?php

namespace Database\Factories\Auth;

use App\Models\Auth\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition()
    {
        $name = $this->faker->name();

        return [
            'name' => $name,
            'display_name' => $name,
            'sort' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
