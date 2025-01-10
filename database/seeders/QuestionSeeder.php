<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Survey::all()->each(function (Survey $survey): void {
            $survey->questions()->saveMany(
                \App\Models\Question::factory()->count(5)->make()
            );
        });
    }
}
