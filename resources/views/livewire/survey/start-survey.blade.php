<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Survey;
use App\Models\ResponseChoice;
use App\Models\Response;

new #[Layout('layouts.guest')] class extends Component {
    //

    public Survey $survey;
    public $answers = [];

    public function mount(Survey $survey)
    {
        $this->survey = $survey->load('questions.choices');
    }

    public function submitSurvey()
    {
        $rules = [];
        $messages = [];

        foreach ($this->survey->questions as $question) {
            $field = "answers.{$question->id}";

            switch ($question->type) {
                case 'text':
                case 'textarea':
                case 'email':
                case 'number':
                case 'date':
                case 'time':
                    $rules[$field] = 'required'; // Example: Make text, textarea, etc., required
                    $messages["{$field}.required"] = 'The question is required.';
                    break;

                case 'radio':
                    $rules[$field] = 'required'; // At least one radio option should be selected
                    $messages["{$field}.required"] = 'Please select an option.';
                    break;

                case 'checkbox':
                    $rules["{$field}"] = 'required|array'; // Ensure it's an array and required
                    $rules["{$field}.*"] = 'distinct'; // Ensure unique choices
                    $messages["{$field}.required"] = 'Please select at least one option.';
                    break;

                case 'select':
                    $rules[$field] = 'required'; // Ensure a value is selected
                    $messages["{$field}.required"] = 'Please select an option.';
                    break;
            }
        }

        $this->validate($rules, $messages);

        foreach ($this->answers as $question_id => $answer) {
            if (is_array($answer)) {
                $survey_answer = Response::create([
                    'survey_id' => $this->survey->id,
                    'question_id' => $question_id,
                    'user_id' => auth()->id() ?? null,
                ]);

                foreach ($answer as $choice_id) {
                    ResponseChoice::create([
                        'response_id' => $survey_answer->id,
                        'choice_id' => $choice_id,
                    ]);
                }
            } else {
                Response::create([
                    'survey_id' => $this->survey->id,
                    'question_id' => $question_id,
                    'user_id' => auth()->id() ?? null,
                ]);
            }
        }

        session()->flash('message', 'Survey submitted successfully!');

        // Redirect to a thank-you page or survey results
        return redirect()->route('survey.thank-you');
    }

    public function with(): array
    {
        return [
            'title' => 'Start Survey',
        ];
    }
}; ?>

<div class="w-[80vw] min-h-screen bg-gray-100 flex justify-center items-center mx-auto">
    <div class="container px-4 py-10 mx-auto">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-blue-600">{{ $survey->title }}</h1>
            <p class="mt-2 text-lg text-gray-700">{{ $survey->description }}</p>
        </div>

        <!-- Survey Questions -->
        <form wire:submit.prevent="submitSurvey">
            <div class="space-y-6">
                @foreach ($survey->questions as $question)
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $question->question }}</h2>

                        @if ($question->type == 'text')
                            <!-- Text Input -->
                            <div class="mt-4">
                                <input type="text" class="w-full border-gray-300 rounded-lg shadow-sm form-input"
                                    wire:model="answers.{{ $question->id }}" placeholder="Enter Your Answer">
                                @error("answers.{$question->id}")
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @elseif ($question->type == 'textarea')
                            <!-- Textarea Input -->
                            <div class="mt-4">
                                <textarea class="w-full border-gray-300 rounded-lg shadow-sm form-textarea" wire:model="answers.{{ $question->id }}"
                                    rows="4" placeholder="textarea...."></textarea>
                                @error("answers.{$question->id}")
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @elseif ($question->type == 'radio')
                            <div class="flex flex-col mt-4 space-y-2">
                                @foreach ($question->choices ?? [] as $choice)
                                    <x-radio id="color-primary" wire:model="answers.{{ $question->id }}"
                                        label="{{ $choice->choice }}" primary value="{{ $choice->id }}" md />
                                @endforeach
                                @error("answers.{$question->id}")
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @elseif ($question->type == 'checkbox')
                            <!-- Checkbox Options -->
                            <div class="flex flex-col mt-4 space-y-2">
                                {{-- @foreach ($question->choices ?? [] as $choice)
                                    <x-checkbox id="question.{{ $question->id }}" label="{{ $choice->choice }}"
                                        wire:model.live="answers.{{ $choice->id }}" value="{{ $choice->id }}" />
                                @endforeach --}}
                                @foreach ($question->choices ?? [] as $choice)
                                    <x-checkbox id="question.{{ $question->id }}_{{ $choice->id }}"
                                        label="{{ $choice->choice }}"
                                        wire:model="answers.{{ $question->id }}.{{ $choice->id }}"
                                        value="{{ $choice->id }}"
                                        wire:click="$set('answers.{{ $question->id }}.{{ $choice->id }}', !isset($answers['{{ $question->id }}']['{{ $choice->id }}']))" />
                                @endforeach
                                @error("answers.{$question->id}")
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror

                            </div>
                        @elseif ($question->type == 'select')
                            <!-- Select Dropdown -->
                            <div class="mt-4">
                                <select class="w-full border-gray-300 rounded-lg shadow-sm form-select"
                                    wire:model="answers.{{ $question->id }}">
                                    <option value="">Please select</option>
                                    @foreach ($question->choices ?? [] as $choice)
                                        <option value="{{ $choice->id }}">{{ $choice->choice }}</option>
                                    @endforeach
                                </select>
                                @error("answers.{$question->id}")
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @elseif ($question->type == 'email')
                            <!-- Email Input -->
                            <div class="mt-4">
                                <input type="email" class="w-full border-gray-300 rounded-lg shadow-sm form-input"
                                    wire:model="answers.{{ $question->id }}" placeholder="example@email.com">
                                @error("answers.{$question->id}")
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @elseif ($question->type == 'number')
                            <!-- Number Input -->
                            <div class="mt-4">
                                <input type="number" class="w-full border-gray-300 rounded-lg shadow-sm form-input"
                                    wire:model="answers.{{ $question->id }}" placeholder="Enter number">
                                @error("answers.{$question->id}")
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @elseif ($question->type == 'date')
                            <!-- Date Picker -->
                            <div class="mt-4">
                                <input type="date" class="w-full border-gray-300 rounded-lg shadow-sm form-input"
                                    wire:model="answers.{{ $question->id }}">
                                @error("answers.{$question->id}")
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @elseif ($question->type == 'time')
                            <!-- Time Picker -->
                            <div class="mt-4">
                                <input type="time" class="w-full border-gray-300 rounded-lg shadow-sm form-input"
                                    wire:model="answers.{{ $question->id }}">
                                @error("answers.{$question->id}")
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="mt-8 text-center">
                <button type="submit" class="px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Submit Survey
                </button>
            </div>
        </form>

        <!-- Success message -->
        @if (session()->has('message'))
            <div class="mt-6 text-center text-green-600">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
