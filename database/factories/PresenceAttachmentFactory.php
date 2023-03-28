<?php

namespace Database\Factories;

use App\Models\Presence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PresenceAttachment>
 */
class PresenceAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'presence_id' => function () {
                return Presence::factory()->create()->id;
            },
            'detail' => 'ini detail',
            'attachment' => fake()->image()
        ];
    }
}
