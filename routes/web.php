<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Results\SectionResults;
use App\Livewire\Results\Dashboard;
use App\Livewire\CsfRating;
use App\Livewire\HomePage;

/* PUBLIC ROUTES */
Route::get('/{section}/csf', CsfRating::class)->name('rate.section');
Route::get('/', HomePage::class)->name('home');
// login page
Route::get('/login', Login::class)->name('login');

/* AUTHENTICATED ROUTES */
Route::middleware('auth')->group(function () {

    // section results
    Route::get('/dashboard',Dashboard::class)->name('dashboard');
    Route::get('/results', SectionResults::class)->name('results.section');
    // logout
    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});
