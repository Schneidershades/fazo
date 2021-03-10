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
                "FlightSearchType" =>$request->flightType,
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
            "SelectData" => $request->selectData
        ];

        return $this->sendRequest('/api/flight/select', $data);
    }

    public function bookFlight($request)
    {
        $data = [
            "PassengerDetails" => [
                [
                    "PassengerType" => "Adult",
                    "FirstName" => "Adeniyi",
                    "MiddleName" => "",
                    "LastName" => "Adedotun",
                    "DateOfBirth" => "09/14/1990",
                    "PhoneNumber" => "+0902343423",
                    "Address" => "No 43, Lagos Str.",
                    "PassportNumber" => "",
                    "ExpiryDate" => "",
                    "PassportIssuingAuthority" => "",
                    "Email" => "olas1@gmail.com",
                    "Gender" => "Female",
                    "Title" => "Ms",
                    "City" => "nisun",
                    "Country" => "Nigeria",
                    "CountryCode" => "NG",
                    "PostalCode" => "100001"
                ]
            ],
            "BookingItemModels" => [
                [
                    "ProductType" => "Flight",
                    "BookingData" =>
                    "qxQAAB+LCAAAAAAABADdV1tP6zgQ/itWnliJVrk0tM1baVnUBUqXRtqVVjw4idNauHbXcYAI8d/POHHahl4OnHP2cnihZGY8M/7mm5nkxfqV0flCDcUyohwrKvgdyXKmrODFqDIr+OvFmuAlsQLL9zzr1BpQySjXz1e/bx6NyRXhBUYge8JFBtoRWWGpckmGItH669vZttScusZz0bAOaSl3bafbcpyW44eOGzh+YNs6opT0ETNzdpRHmG6kJs7oz/ON7K23bmg74KryNlNiBbd0qv+MqdOGeB0TL5R0NcpliU+ps/trnT4zpKqwAp4zdmpQuybzCrgPXB+d3ORSYYbRTb7AyyVJ0JgrIqu6YKZBXQmpfikdZMoUzDienN825cb1BFMpIop+E0uByuIohdHJfjHeRJgpyPBoFS54skffDzyj30LM9gPXoD3ONGJWkGKWkVO4eSEeifyORI2HrWiut452LsQD5fMhwxnUwwpBNMRA9Vpw0xAYyC5iwcWyANXtimiv4AADkco0S8q/lR/g/g2WD2TP8Yojk3wZlbJ1V8USp9B6VtfraSsMbVCstOO7c/Mc4YxmpuLhOJxc6vyFxgKrmmJn/U7f99dhZoSRWI2wwhVFX093WVmTp8nKb63ILjmrZtwlZ9m66KT6OUj2vVQ8C51e4B+mYqPFm1S0/eNUrBp5l1elt5+IV55jv+FV75/k1b1mlsnYs/3vXRQ1Z5qcrIf9oUXheqF9tuZFc1HUS6a5KKqJvH9RuJ3QcQLXP7oo7E7g2YcWRXet++CiOHL9rzbMf7MdmtDvtiToAUxnb0s6X2nJH7kdnJ+si+tW+rTboX4nekvOD78V7WVlJ7R7a9btYWWjxT/Gys+yKHzP/Tcpdv96D7USuYy19WCJE5JnpR/OwRIwHCeaYJet2zSlYLStMjHsLkinUmvhU2WwFDmHxJ1ev9fptt0enMilJDwuag5fTqzXw4AMEvjoqWb7cEFZAketwIbK8xRzrbBNtBFRmLJqZE+hYoTPiTQglU6shqHRnOOMVMnuSbrfPXM6bftQyoPVilGS6GOQ913OSE28i+d4gSH+HUAPqWsXxnhG5CNE2TYuw455BXsdaTsNezeFaiCYUjWjgbUeFe+HIMTPey9vuz3n01/eTCx2AASn77tHSPv/BeG+Ggo6im4JK6QxtFeGBpKgieCtO5LmPMERK4nPCLQBIjyDJYLUAitUiBwt8CNBGMHLF03QI80wikgqwAKUEtHGrFcSjFkb/YEfMBdP7Vgs0RNlDHGh4BhaEJYgRnVAFBX11kE4VwshqaIkQzTdRNWn0pyl4AHWShmvTECSv3MqyZJA67eRfq9b0AxV0wzpCyN9Y9RCAKn2WyAXHi74nNFsgULyrFkwljA6UCwJoJXAdcHD2tzZ56xxHpCdEriyKtbgDjGPCWMlFgjzBMFIJWhYlgStKmOEdfljDUAbTWtZWd8KqISAZYLAg1qQyoN2pZciEilqxBByO0Rb53RJxFzi1aIoJzSfa2yEqoj9LiaZb4CNTG/XLZrUO3bMY5YnZIqL2RIzVv6xAiVz0I3EEweFLk/VZWM+JcBPrvAcPHh6Vm+fuxbxQ3mm6jvf6/d7uoOtGckyuOgVKTZ7KCB2fJZ48GaQRulZq5PEUSvq9nELd52470Q91yVR3cTnUN2HXH8UvFhvIOi7rucdaWow/6G9CLDQLK4OH3Vj6ejr0fX+pVbLh2ZmfXyTffMAgjeG1y/XdifYqxQAAA==",
                    "BookingId" => "1707310600002",
                    "TargetCurrency" => "NGN"
                ]
            ],
            "BookingId" => "1707310600002"
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
