<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

use Illuminate\Support\Facades\Route;

Route::resource('flight-check', 'Api\Flight\FlightCheckController');
Route::resource('flight-select', 'Api\Flight\FlightSelectController');
Route::resource('flight-book', 'Api\Flight\FlightBookingController');
Route::resource('flight-ticket', 'Api\Flight\FlightTicketController');
