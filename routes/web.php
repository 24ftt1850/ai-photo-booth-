<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeminiController;

Route::get('/photobooth', function () {
    return view('photobooth.create');
})->name('photobooth.create');

Route::get('/photobooth/scene', function () {
    return view('photobooth.scene');
})->name('photobooth.scene');

Route::get('/photobooth/generate', function () {
    return view('photobooth.generate');
})->name('photobooth.generate');

Route::post('/gemini-generate', [
    GeminiController::class,
    'generateImage'
])->name('gemini.generate');

Route::get('/photobooth/result', function () {
    return view('photobooth.result');
})->name('photobooth.result');

Route::post(
    '/gemini-generate',
    [GeminiController::class, 'generateImage']
)->name('gemini.generate');
