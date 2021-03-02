<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/flight-check', [App\Http\Controllers\Flight\FlightCheckController::class, 'store'])->name('flight-check');
