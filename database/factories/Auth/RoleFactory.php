<?php

namespace Database\Factories\Auth;

use App\Models\Auth\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'all' => $this->faker->randomElement([0, 1]),
            'sort' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
