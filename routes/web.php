<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeminiController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/events', [EventController::class, 'index'])
    ->middleware('auth')
    ->name('events.index');

Route::get('/gemini-test', [GeminiController::class, 'test'])
    ->middleware('auth')
    ->name('gemini.test');

Route::get('/gemini-generate', [GeminiController::class, 'generateImage'])
    ->name('gemini.generate');

require __DIR__.'/admin.php';