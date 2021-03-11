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

    public static function verifyTransaction($reference, $transactionId=null)
    {
        $credentials = Flutterwave::credentials(env('FLUTTERWAVE_MODE'));
        
        $ref = $reference;
        $amount = "";
        $currency = "";

        $response = Http::post('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify', [
            "SECKEY" => $credentials['secret_key'],
            "txref" => $ref
        ]);

        $resp = json_decode($response->body(), true);

        $orderNumber = $resp['data']['meta'];
        $orderId = $orderNumber[0]['metavalue'];
        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];
        $payment_reference = $resp['data']['txref'];
        $payment_gateway_charge = $resp['data']['appfee'];
        $payment_gateway_remittance = $resp['data']['amountsettledforthistransaction'];
        $payment_code = $resp['data']['chargecode'];
        $payment_status = $resp['data']['status'];


        $model = Order::where('receipt_number',  $orderId)->first();

        $discount = $model->total - $chargeAmount;

        $free_discount = false;

        if($discount > 0){
            $free_discount = true;
        }

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
                'discounted_amount' => $discount,
                'free_discount' => $free_discount,
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
