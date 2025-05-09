<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AutoFactory extends Factory
{

    public function definition(): array
    {
        $brands = ['bmw', 'audi', 'niva'];
        return [
            'brand' => fake()->randomElement($brands),
            'class' => mt_rand(1, 3),
            'number' => Str::random(10),
            'driver_id' => 1,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */

}
