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
    	$resp = Flutterwave::verifyTransaction($request->reference);

    	if($resp['success'] == false){
    		return $this->errorResponse('failed transaction');
    	}

    	Flight::bookFlight($request);

        return $this->showMessage('good');
    }
}
