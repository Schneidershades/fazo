<?php

return [
	// payment gateway
	
    'flutterwave_public_key' => env('THIRD_PARTY_API_MODE') == 'test' ? env('FLUTTERWAVE_TEST_PUBLIC_KEY') : env('FLUTTERWAVE_LIVE_PUBLIC_KEY'),
    'flutterwave_secret_key' => env('THIRD_PARTY_API_MODE') == 'test' ? env('FLUTTERWAVE_TEST_SECRET_KEY') : env('FLUTTERWAVE_LIVE_SECRET_KEY'),
    'flutterwave_encryption_key' => env('THIRD_PARTY_API_MODE') == 'test' ?env('FLUTTERWAVE_TEST_ENCRYPTION_KEY') : env('FLUTTERWAVE_LIVE_ENCRYPTION_KEY'),
];

