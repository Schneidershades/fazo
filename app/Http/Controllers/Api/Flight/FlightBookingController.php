<?php

namespace App\Http\Controllers\Api\Flight;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlightBooking;
use App\Traits\Provider\Wakanow\Flight;

class FlightBookingController extends Controller
{
    public function store(Request $request)
    {
        foreach ($request->passengers as $passenger) {
            $model = new FlightBooking;
            $model = $this->contentAndDbIntersection($passenger, $model);
            $model->save();
        }
        return $this->showMessage('flight booked');
    }

    public function show($id)
    {
        $model = FlightBooking::where('booking_id', $id)->get();
        // return $this->showAll($model);
        return $model;
    }
}
