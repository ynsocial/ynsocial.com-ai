<?php

namespace Database\Factories;

use App\Models\Envelope;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnvelopeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Envelope::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject'    => rtrim($this->faker->sentence($nbWords = rand(3, 7)), '.'),
            'message'       => $this->faker->paragraph($nbSentences = rand(3, 20)),
            'name'       => $this->faker->name,
            'email'      => $this->faker->unique()->safeEmail,
            'phone'      => $this->faker->e164PhoneNumber,
            'unread'     => $this->faker->numberBetween(0, 1),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = null),
            'updated_at' => null,
        ];
    }
}
