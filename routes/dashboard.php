<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\AuthController;


Route::middleware('doctor')->get('/', function () {
    return view('dashboard.welcome');
})->name('welcome');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'show')->name('login.index');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});
