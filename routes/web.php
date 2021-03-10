<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('flight-check', 'Web\Flight\FlightCheckController@store')->name('flight-check');

Route::get('flight-list', 'Web\Flight\FlightListController@store')->name('flight-list');
