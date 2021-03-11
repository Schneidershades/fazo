<?php

namespace App\Traits\Provider\Wakanow;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class Flight
{
    public function credentials($testing_api)
    {
        if ($testing_api == "test") {
            return [
                'grant_type' => 'password',
                'username' => '15a9efddb90c4a678768b8bf78707afa',
                'password' => '_0GZIjuqlC',
                'url' => 'https://wakanow-api-affiliate-b2b-devtest-test.azurewebsites.net',
            ];
        }
        if ($testing_api == "live") {
            return [
                'grant_type' => 'password',
                'username' => '15a9efddb90c4a678768b8bf78707afa',
                'password' => '_0GZIjuqlC',
                'url' => 'https://wakanow-api-affiliate-b2b-devtest-test.azurewebsites.net',
            ];
        }
    }

    public function authenticate()
    {
        $credential = $this->credentials('test');

        $data = [
            'grant_type' => 'password',
            'username' => '15a9efddb90c4a678768b8bf78707afa',
            'password' => '_0GZIjuqlC',
        ];

        $content = Http::withOptions([
            'verify' => false,
        ])->asForm()->post($credential['url'] . '/token', [
            'grant_type' => 'password',
            'username' => '15a9efddb90c4a678768b8bf78707afa',
            'password' => '_0GZIjuqlC',
        ]);

        $resp = json_decode($content->body(), true);

        return $resp;
    }

    public function searchFlight($request)
    {
        $credential = $this->credentials('test');

        if ($request->flightSearchType == 'Oneway') {
            $data = [
                "FlightSearchType" => $request->flightSearchType,
                "Adults" => (string)$request->adults,
                "Children" => (string)$request->children,
                "Infants" => (string)$request->infants,
                "Ticketclass" => "Y",
                "TargetCurrency" => "NGN",
                "Itineraries" => [
                    [
                        "Departure" => $request->departure,
                        "Destination" => $request->destination,
                        "DepartureDate" => Carbon::parse($request->depatureDate)->format('Y-m-d')
                    ]
                ]
            ];
        }

        if($request->flightSearchType == 'Return'){
            $data = [
                "FlightSearchType" =>$request->flightSearchType,
                "Adults" => (string)$request->adults,
                "Children" => (string)$request->children,
                "Infants" => (string)$request->infants,
                "Ticketclass" => "Y",
                "TargetCurrency" => "NGN",
                "Itineraries" => [
                    [
                        "Departure" => $request->departure,
                        "Destination" => $request->destination,
                        "DepartureDate" => Carbon::parse($request->depatureDate)->format('Y-m-d')
                    ],
                    [
                        "Departure" => $request->destination,
                        "Destination" => $request->departure,
                        "DepartureDate" => Carbon::parse($request->returnDate)->format('Y-m-d')
                    ]
                ]
            ];
        }

        return $this->sendRequest('/api/flight/search', $data);
    }

    public function selectFlight($request)
    {
        $credential = $this->credentials('test');

        $data = [
            "TargetCurrency" => "NGN",
            "SelectData" => $request->SelectData
        ];

        return $this->sendRequest('/api/flight/select', $data);
    }

    public function bookFlight($request)
    {
        $data = [
            "PassengerDetails" => $request->passengerDetails,
            "BookingItemModels" => [
                [
                    "ProductType" => "Flight",
                    "BookingData" => $request->bookingData,
                    "BookingId" => $request->bookingId,
                    "TargetCurrency" => $request->targetCurrency
                ]
            ],
            "BookingId" => $request->bookingId
        ];


        return $this->sendRequest('/api/flight/book', $data);
    }

    public function ticketFlight($request)
    {
        $data = [
            "BookingId" => "1707310600002",
            "PnrNumber" => " UPTR7U "
        ];

        return $this->sendRequest('/api/flight/book', $data);
    }

    private function sendRequest($endpoint, $data)
    {
        $credential = $this->credentials('test');

        $item = $this->authenticate();

        $content = Http::withOptions([
            'verify' => false,
        ])->withToken($item['access_token'])->post($credential['url'] .$endpoint, $data);

        return json_decode($content->body(), true);
    }



}
