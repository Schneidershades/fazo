<?php

use Illuminate\Support\Facades\Route;

Route::resource('flight-check', 'Api\Flight\FlightCheckController');
Route::resource('travel-selecting', 'Api\Flight\FlightSelectController');
Route::resource('flight-book', 'Api\Flight\FlightBookingController');
Route::resource('flight-ticket', 'Api\Flight\FlightTicketController');
