<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Response>
 */
class ResponseFactory extends Factory
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
            'survey_id' => $this->faker->numberBetween(1, 10),
            'question_id' => $this->faker->numberBetween(1, 10),
            'choice_id' => $this->faker->numberBetween(1, 10),
            'answer' => $this->faker->sentence,
        ];
    }
}
