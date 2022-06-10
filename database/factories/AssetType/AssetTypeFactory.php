<?php

namespace Database\Factories\AssetType;

use App\Models\AssetType\AssetType;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetTypeFactory extends Factory
{
    protected $model = AssetType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(4, true),
            'created_by' => fn () => User::factory()->create()->id,
        ];
    }
}
