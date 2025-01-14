<?php

namespace Database\Factories;

use App\Models\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'question' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['text', 'textarea', 'radio', 'checkbox', 'select', 'email', 'number', 'date', 'time']),
        ];
    }
}
