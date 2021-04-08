<?php

namespace App\Traits\Provider\Payments;

use Illuminate\Support\Facades\Http;

class Flutterwave
{
    public static function credentials($testing_api)
    {
        if ($testing_api == "test") {
            return [
                'public_key' => env('FLUTTERWAVE_TEST_PUBLIC_KEY'),
                'secret_key' => env('FLUTTERWAVE_TEST_SECRET_KEY'),
                'encryption_key' => env('FLUTTERWAVE_TEST_ENCRYPTION_KEY'),
            ];
        }
        if ($testing_api == "live") {
            return [
                'public_key' => env('FLUTTERWAVE_LIVE_PUBLIC_KEY'),
                'secret_key' => env('FLUTTERWAVE_LIVE_SECRET_KEY'),
                'encryption_key' => env('FLUTTERWAVE_LIVE_ENCRYPTION_KEY'),
            ];
        }
    }

    public static function verifyTransaction($reference)
    {
        $ref = $reference;
        $amount = "";
        $currency = "";

        $query = array(
            "SECKEY" => config('thirdpartyapi.flutterwave_secret_key'),
            "txref" => $ref
        );

        $data_string = json_encode($query);

        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $chargeResponsecode = $resp['data']['chargecode'];

        $orderNumber = $resp['data']['meta'];
        $orderId = $resp['data']['txref'];
        $paymentStatus = $resp['data']['status'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];
        $payment_reference = $resp['data']['txref'];
        $payment_gateway_charge = $resp['data']['appfee'];
        $payment_gateway_remittance = $resp['data']['amountsettledforthistransaction'];
        $payment_code = $resp['data']['chargecode'];
        $payment_status = $resp['data']['status'];


        if (($chargeResponsecode == "00" || $chargeResponsecode == "0")) {
            return [
                'payment_method' => 'card',
                'payment_gateway' => 'flutterwave',
                'success' => true,
                'payment' => true,
                'payment_reference' => $payment_reference,
                'payment_gateway_charge' => (float)$payment_gateway_charge,
                'payment_gateway_remittance' => (float)$payment_gateway_remittance,
                'payment_code' => $payment_code,
                'payment_message' => $paymentStatus,
                'payment_status' => $payment_status,
                'orderId' => $orderId,
                'total' => $chargeAmount,
                'amount_paid' => $chargeAmount,
            ];
        } else {

            return [
                'payment_method' => 'card-failure-process',
                'payment_gateway' => 'flutterwave',
                'success' => false,
                'payment' => false,
                'payment_reference' => $payment_reference,
                'payment_gateway_charge' => (float)$payment_gateway_charge,
                'payment_gateway_remittance' => (float)$payment_gateway_remittance,
                'payment_code' => $payment_code,
                'payment_message' => $paymentStatus,
                'payment_status' => $payment_status,
                'orderId' => $orderId,
            ];
        }
    }
}
