<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
 */
class SurveyFactory extends Factory
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
            'title'=>$this->faker->sentence,
            'description'=>$this->faker->paragraph,
            'status'=>$this->faker->randomElement(['draft', 'published']),
            'start_date'=>$this->faker->dateTimeBetween('-1 month', '+1 month'),
            'end_date'=>$this->faker->dateTimeBetween('+1 month', '+2 month'),
        ];
    }
}
