<?php

namespace App\Http\Controllers\Api\Flight;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Provider\Payments\Flutterwave;
use App\Traits\Provider\Wakanow\Flight;

class FlightPaymentController extends Controller
{
    public function store(Request $request)
    {
    	// $request->passengerDetails;

    	$resp = Flutterwave::verifyTransaction($request->payment_reference);

    	if($resp['success'] == false){
    		return $this->errorResponse('failed transaction');
    	}

    	$book = new Flight();

    	return $book->bookFlight($request->all());

        return $this->showMessage('good');
    }
}
