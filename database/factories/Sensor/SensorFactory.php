<?php

namespace Database\Factories\Sensor;

use App\Models\Auth\User;
use App\Models\Sensor\Sensor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SensorFactory extends Factory
{
    protected $model = Sensor::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(4, true),
            'created_by' => fn () => User::factory()->create()->id,
        ];
    }
}
