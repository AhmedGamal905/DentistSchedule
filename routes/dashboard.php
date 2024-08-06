<?php

use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\AuthController;
use App\Http\Controllers\Doctor\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:doctor')->group(function () {
    Route::get('/', function () {
        return view('dashboard.welcome');
    })->name('welcome');

    Route::resource('appointment', AppointmentController::class)->except(['show', 'edit', 'update']);

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'show')->name('login.index');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});
