<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Survey;

new #[Layout('layouts.guest')] class extends Component {
    //
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function with(): array
    {
        return [
            'title' => 'Show Surveys',
            'surveys' => Survey::query()
                ->where('end_date', '>=', now())
                ->when($this->search, function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                })
                ->paginate(6),
        ];
    }
}; ?>

<div>
    <div class="min-h-screen bg-gray-100">
        <!-- Hero Section -->
        <div class="py-10 text-center text-white bg-blue-600">
            <h1 class="text-4xl font-bold">Participate in Surveys</h1>
            <p class="mt-2 text-lg">Share your opinion and help us gather valuable insights!</p>
        </div>

        {{-- Search Survey --}}

        <div class="relative w-full max-w-md mx-auto">
            <x-input type="text" placeholder="Search surveys..." wire:model.live="search"
                class="w-full py-2 pl-10 pr-4 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500" />
            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 16l2 2 4-4M7 10a5 5 0 100-10 5 5 0 000 10z" />
                </svg>
            </div>
        </div>


        <!-- Survey List -->
        <div class="container px-4 py-8 mx-auto">
            <h2 class="mb-6 text-2xl font-semibold text-gray-800">Available Surveys</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Survey Card -->
                @foreach ($surveys as $survey)
                    <div
                        class="flex flex-col justify-between p-6 transition-shadow duration-300 bg-white rounded-lg shadow-lg hover:shadow-2xl">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $survey->title }}</h3>
                            <p class="mt-2 text-gray-600">{{ $survey->description }}</p>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-sm text-gray-500">
                                Ends on: {{ \Carbon\Carbon::parse($survey->end_date)->format('M d, Y') }}
                            </span>
                            {{--  --}}
                            <a href="{{ route('survey.show-survey', $survey->id) }}"
                                class="px-4 py-2 text-white transition-colors bg-blue-600 rounded hover:bg-blue-700">
                                Take Survey
                            </a>
                        </div>
                    </div>
                @endforeach

                <!-- Empty State -->
                @if ($surveys->isEmpty())
                    <div class="text-center text-gray-500 col-span-full">
                        <p>No surveys available at the moment.</p>
                    </div>
                @endif
            </div>
            <div class="mt-8">
                {{ $surveys->links() }}
            </div>
        </div>
    </div>

</div>
