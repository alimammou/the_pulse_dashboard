<?php

namespace Database\Factories\Vendor;

use App\Enums\Status;
use App\Models\Auth\User;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    protected $model = Vendor::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(4, true),
            'status' => $this->faker->randomElement(Status::asArray()),
            'description' => $this->faker->text,
            'email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'created_by' => fn () => User::factory()->create()->id,
        ];
    }
}
