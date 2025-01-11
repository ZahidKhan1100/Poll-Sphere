<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Volt::route('survey/show/{survey}', 'survey.show-survey')->name('survey.show-survey');
Volt::route('survey/start/{survey}', 'survey.start-survey')->name('survey.start-survey');
Volt::route('survey.thank-you', 'survey.thank-you')->name('survey.thank-you');




require __DIR__ . '/auth.php';
