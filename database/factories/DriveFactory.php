<?php

namespace Database\Factories;

use App\Models\Auto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class DriveFactory extends Factory
{

    public function definition(): array
    {
        $autosIds = Auto::all()->pluck('id')->toArray();
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = clone $startDate;
        $endDate->modify('+'.rand(1, 8).' hours');

        return [
            'start' =>  $startDate,
            'end' =>  $endDate,
            'status' => 1,
            'auto_id' => $autosIds[array_rand($autosIds)],
            'user_id' => mt_rand(1,3),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */

}
