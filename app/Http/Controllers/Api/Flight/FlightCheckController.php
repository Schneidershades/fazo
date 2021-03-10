<?php

namespace App\Http\Controllers\Api\Flight;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Provider\Wakanow\Flight;

class FlightCheckController extends Controller
{
    public function store(Request $request)
    {
    	$flight = new Flight;
    	$search = $flight->searchFlight($request);
    	return $this->showMessage($search);
    }
}
