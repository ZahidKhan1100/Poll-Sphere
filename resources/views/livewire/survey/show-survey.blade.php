<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Survey;

new #[Layout('layouts.guest')] class extends Component {
    //

    public Survey $survey;

    public function mount(Survey $survey)
    {
        $this->survey = $survey->load('user');
    }

    public function with(): array
    {
        return [
            'title' => $this->survey->title,
        ];
    }
}; ?>

<div>

    <div class="min-h-[60vh] bg-gray-100">

        <div class="container px-4 py-10 mx-auto">

            <!-- Back Button -->
            <div class="mb-6">
                <button onclick="window.history.back()"
                    class="px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700">
                    &larr; Back to Surveys
                </button>
            </div>
            <!-- Survey Details -->
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold text-blue-600">{{ $survey->title }}</h1>
                <p class="mt-2 text-gray-700">{{ $survey->description }}</p>

                <div class="flex flex-col mt-4 space-y-2">
                    <p class="text-sm text-gray-500">Created by:
                        <span class="font-medium text-gray-800">{{ $survey->user->name }}</span>
                    </p>
                    <p class="text-sm text-gray-500">Ends on:
                        <span class="font-medium text-gray-800" x-data x-init="$watch('$store.time', () => $store.time = '{{ $survey->end_date }}')">
                            {{ \Carbon\Carbon::parse($survey->end_date)->format('M d, Y h:i A') }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Start Button -->
            <div class="flex justify-center mt-10">
                @if (\Carbon\Carbon::now()->lessThan($survey->end_date))
                    <a href="{{ route('survey.start-survey', $survey->id) }}"
                        class="px-6 py-3 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                        Start Survey
                    </a>
                @else
                    <div class="px-6 py-3 text-white bg-red-500 rounded-lg">
                        This survey has ended.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
