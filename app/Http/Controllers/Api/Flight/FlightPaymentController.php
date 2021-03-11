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
    	$resp = Flutterwave::verifyTransaction($request->payment_reference);

    	if($resp['success'] == true){
    		$place 
    	}

        return $this->showOne();
    }
}
