<?php

namespace App\Http\Controllers\Flight;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Provider\Wakanow\Flight;

class FlightCheckController extends Controller
{
    public function store(Request $request)
    {
    	$flight = new Flight;
    	$search = $flight->authenticate($request);

    	return ($search);
    }
}
