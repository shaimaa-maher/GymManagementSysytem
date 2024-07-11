<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName($gender = null|'male'|'female'),
            'email' => $this->fake->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'payment' => $this->faker->randomElement(['visa','cash','credit','online']),
            'membership_cost'=>$this->faker->randomFloat(2),
            'membership_period'=>$this->faker->randomElement(['Monthly','Yearly','3 Months']),
            'barcode_number'=>$this->faker->ean13(),
        ];
    }
}
