<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presence>
 */
class PresenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sdm_id' => function () {
                return User::factory()->create()->id;
            },
            'check_in_time' => Carbon::today(),
            'latitude_in' => 80,
            'longitude_in' => 80,
            'check_out_time' => Carbon::today(),
            'latitude_out' => 80,
            'longitude_out' => 80,
            'permission' => 0
        ];
    }
}
