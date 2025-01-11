<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;


new #[Layout('layouts.guest')] class extends Component {
    //
}; ?>

<div class="flex min-h-[50vh] justify-center items-center bg-gray-100">
    <div class="w-full max-w-lg p-8 bg-white rounded-lg shadow-lg">
        <div class="text-center">
            <h1 class="text-3xl font-semibold text-blue-600">Thank You for Completing the Survey!</h1>
            <p class="mt-4 text-lg text-gray-700">We appreciate your time and feedback.</p>
            @if (session()->has('message'))
                <div class="px-4 py-2 mt-6 text-white bg-green-500 rounded-lg">
                    <p class="font-medium">{{ session('message') }}</p>
                </div>
            @endif

            <div class="mt-8">
                <a href="/"
                    class="inline-block px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
