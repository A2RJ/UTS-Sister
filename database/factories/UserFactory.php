<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sdm_id' => fake()->uuid,
            'sdm_name' => fake()->name,
            'email' => fake()->email(),
            'nidn' => fake()->unique()->numberBetween(1000000000, 9999999999),
            'password' => Hash::make('password'),
            'nidn' => '1234567890',
            'nip' => '123456789',
            'active_status_name' => 'Active',
            'employee_status' => 'Permanent',
            'sdm_type' => 'Dosen',
            'is_sister_exist' => true,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
