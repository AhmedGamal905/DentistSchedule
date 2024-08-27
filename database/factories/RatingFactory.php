<?php

namespace Database\Factories;

use App\Models\Rating;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition()
    {
        return [
            'appointment_id' => Appointment::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
