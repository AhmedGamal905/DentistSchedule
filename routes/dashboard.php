<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\AuthController;
use App\Http\Controllers\Doctor\UserController;
use App\Http\Controllers\Doctor\AppointmentController;


Route::middleware('doctor')->get('/', function () {
    return view('dashboard.welcome');
})->name('welcome');

Route::middleware('doctor')->resource('/appointment', AppointmentController::class)->except(['show', 'edit', 'update']);

Route::middleware('doctor')->get('/users', [UserController::class, 'index'])->name('user.index');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'show')->name('login.index');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});
