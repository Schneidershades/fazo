<?php

namespace App\Traits\Provider\Wakanow;

use Illuminate\Support\Facades\Http;

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
        ])->post($credential['url'] . '/token', $data);

        $resp = json_decode($content->body(), true);

        dd($resp);

        return $resp;
    }

    public function searchFlight($request)
    {
        if ($request['flightType'] == 'Oneway') {
            $data = [
                "FlightSearchType" => "Oneway",
                "Adults" => "1",
                "Children" => "0",
                "Infants" => "0",
                "Ticketclass" => "Y",
                "TargetCurrency" => "NGN",
                "Itineraries" => [
                    [
                        "Departure" => "LOS",
                        "Destination" => "DXB",
                        "DepartureDate" => "10/03/2021"
                    ]
                ]
            ];
        }

        if($request['flightType'] == 'Return'){
            $data = [
                "FlightSearchType" => "Return",
                "Adults" => "1",
                "Children" => "0",
                "Infants" => "0",
                "Ticketclass" => "Y",
                "TargetCurrency" => "NGN",
                "Itineraries" => [
                    [
                        "Departure" => "LOS",
                        "Destination" => "DXB",
                        "DepartureDate" => "11/15/2017"
                    ],
                    [
                        "Departure" => "DXB",
                        "Destination" => "LOS",
                        "DepartureDate" => "11/23/2017"
                    ]
                ]
            ];
        }

        $item = $this->authenticate();

        $content = Http::withOptions([
            'verify' => false,
        ])->withToken($item->access_token)->post($credential['url'] . '/api/flight/search', $data);

        $resp = json_decode($content->body(), true);

        return $resp;
    }

    public function selectFlight($request)
    {
        $data = [
            "TargetCurrency" => "NGN",
            "SelectData" => "
            oRIAAB+LCAAAAAAABADlV21v4zYM/iuCP92ANvBL3DT+lpeuyNqmXWNgA4Z+YGIlESpLmSy3NYr+91G2nMSt013vhtvu9iWJSYqkHj4knW
            fnZ85Waz2S6ZwJ0EyKW5rlXDvRs1VlTvTHszOFlDqREwaBc+QMmOJMmOeLX3eP1uSCigIIyh6hyFA7phtQOld0JBOjv7ye7UvtqUtYyYZ1
            zEq573q9Y8879sLY8yMvjFzXRFSKPQC3Z8f5HNhOauOMfx/uZK+9ncRuGAXW20zLDd7Sq35ZU68X+W6ljxXbjHNVomM03a3G2I+YLpxI5J
            wfWcQu6aoC7QNXJ5+ucqWBA7nK15CmNCEToamqagLcALqRSv9UOsi0LZZ1PB1eN+XW9RSYknNGfpGpJGVhtAbyqV0MuwgzjRm+W4EzkbTo
            +1tM9/BCpGu8JplBzImWwDN6hDcv5ANVX5Go9bAfLYi6NoehlPdMrEYcMqyHE6NoBEjzWnDVEFjIzhZSyLRA1fWGGq/oAJBEZZol3V/LD/
            D+CtQ9bTlecWSap/NStu2ohYIltp3TC06NFWALFBvj+HZon+eQscxWPJ7E03OTvzRYgK4pdtLv9sNwG2ZGOV3oMWioKPpy9JaVNXmarPzS
            irwlZ9WIb8lZti35VH0dJPsBKvrBllQtVGy0d5OKNYEPUbFq5BZemWjfEa8Ct/steXVnmGUzDtzwa5dEzZkmJ+tBf2hJ+EHsnkRh65KoF0
            xzSVQTuX1J+N3Y8yL/3SXRcbtRcGBNdNzeVvfBRfHO9f+2Yf6d7dCE/m1Loh7B9Nwvacl/cDv43vfWxeEPvh3qd6LX5PzwW1ErK7uxe7pl
            XQsrGy3+/1wUYeB/20Vxh7WSuVoY60EKCc2z0o8QaIkYThJDsPPj6+WSodG+ysZweyi9UUaLf1MGqcwFJu71+v2+1+l28USuFBWLoubw+d
            R5OQzIIME/PNVsH60ZT/CoE7lYebEEYRSujTamGhivRvYNVoyKFVUWpNKJ0zC0miFktEq2JenTU7/nd9xDKQ82G85oYo5h3rc5pzXxzp4W
            a8D4twg9pm5cWOMZVQ8YZd+4DDsRFex1pP003LcpVAPBlqoZDa3NqPh8CGJ4ar18vx92f/jL24nFD4Dg9U7Cd0j73wXhrhoKJoppCSdmC2
            yvjAwUJVMpjm/pMhcJzHlJfE6xDQgVGS4RotegSSFzsoYHSoDgyxdLyAPLgMzpUqIFKhVhjVmvFRrzDvkN7kHIx85CpuSRcU6E1HiMrClP
            CGcmIJkX9dYhkOu1VEwzmhG23EU1p5Y5X6IHXCtlvDIBRf/MmaIpxdbvEPNet2YZqaYZMRcm5sbkmCCkxm9BfHw4EyvOsjWJ6ZNhwUTh6C
            ALRRGtBK+LHrbmXpuzxnlE9obilXVhwa1qeE7lSsFmXZQTUqxMblJXxPqsStp38J3MbLe9MtU7biIWPE/oDRSzFDgvP5xIqxx1Y/koUGHg
            qVg+ETcU+SE0rNBDYGbl/rlLubgvz1S8D4N+/9R0kDOjWYaFvaBFg6NDxOw+39hLv/wFUD8AuKESAAA="
        ];

        $item = $this->authenticate();

        $content = Http::withOptions([
            'verify' => false,
        ])->withToken($item->access_token)->post($credential['url'] . '/api/flight/select', $data);

        $resp = json_decode($content->body(), true);

        return $resp;
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

        $item = $this->authenticate();

        $content = Http::withOptions([
            'verify' => false,
        ])->withToken($item->access_token)->post($credential['url'] . '/api/flight/book', $data);

        $resp = json_decode($content->body(), true);

        return $resp;
    }

    public function ticketFlight($request)
    {
        $data = [
            "BookingId" => "1707310600002",
            "PnrNumber" => " UPTR7U "
        ];

        $item = $this->authenticate();

        $content = Http::withOptions([
            'verify' => false,
        ])->withToken($item->access_token)->post($credential['url'] . '/api/flight/book', $data);

        $resp = json_decode($content->body(), true);

        return $resp;
    }

}
