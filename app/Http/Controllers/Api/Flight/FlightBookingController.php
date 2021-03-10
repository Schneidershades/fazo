<?php

namespace App\Http\Controllers\Api\Flight;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Provider\Wakanow\Flight;

class FlightBookingController extends Controller
{
    public function store(Request $request)
    {
    	$request->lines;

    	$arrayPassenger = [];

    	foreach ($request->lines as $lines) {
    		
    	}
    	// $flight = new Flight;
    	// $search = $flight->selectFlight($request);
    	// return $this->showMessage($search);
    }
}
