<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::controller(ViewController::class)->group(function () {
    Route::get('/services', 'showServices')->name('services');
    Route::get('/insurance-pricing', 'showPricing')->name('pricing');
    Route::get('/location', 'showLocation')->name('location');
    Route::get('/contact', 'showContact')->name('contact');
    // Route::get('/route1', 'method1');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
