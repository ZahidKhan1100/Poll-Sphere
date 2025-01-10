<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Question::all()->each(function (Question $question): void {
            $question->choices()->saveMany(
                \App\Models\Choice::factory()->count(4)->make()
            );
        });
    }
}
