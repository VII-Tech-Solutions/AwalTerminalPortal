<?php

namespace App\Http\Controllers;

use App\API\Controllers\CustomController;
use App\Constants\Attributes;
use App\Constants\PaymentGateways;
use App\Constants\PaymentStatus;
use App\Helpers;
use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use VIITech\Helpers\GlobalHelpers;

class CredimaxController extends CustomController
{

    static function checkout($data)
    {
        Log::info("CredimaxController@checkout");

        // get data
        $result = [];
        $success_url = $data['success_url'];
        $error_url = $data['error_url'];
        $amount = $data['amount'];
        $order_id = $data['order_id'];
        $description = $data['description'];

        $error_message = null;
        $process_url = url("/elite-service/" . $order_id . "/pay/process");
        $currency = config('services.merchant.currency');

        if (!GlobalHelpers::isDevelopmentEnv()) {
            $amount = '0.100';
            $description = '0.100';
        }

        // gateway accepts 2 decimals only and third one should be zero
        $amount = GlobalHelpers::formatNumber($amount, 2) . 0;

        $create_session_data = [
            "apiOperation" => "INITIATE_CHECKOUT",
            "apiPassword" => config('services.credimax.api_password'),
            "apiUsername" => "merchant." . config('services.credimax.merchant_id'),
            "interaction.returnUrl" => $process_url,
            "merchant" => config('services.credimax.merchant_id'),
            "order.amount" => $amount,
            "order.currency" => $currency,
            "order.id" => $order_id,
            "interaction.operation" => "PURCHASE",
            "interaction.merchant.name" => "Awal Terminal Portal",
            "interaction.displayControl.billingAddress" => "HIDE",
            "order.description" => "Booking",
        ];

        Log::info('session data: ' . json_encode($create_session_data));

        $client = new Client();
        $response = $client->request('POST', "https://credimax.gateway.mastercard.com/api/nvp/version/68", [
            'form_params' => $create_session_data
        ]);

        $response_body = Helpers::parseQuery($response->getBody()->getContents());
        $request_response_result = $response_body['result']; #return SUCCESS or FAIL
        Log::info('Credimax Response: ' . $request_response_result);


        if ($request_response_result == 'SUCCESS') {
            $result['session_id'] = $response_body['session.id'];
            $result['merchant_id'] = config('services.credimax.merchant_id');
        } else {
            $error_message = 'An error occurred while connecting to the payment gateway';
        }

        $session_id = $result['session_id'] ?? null;

        // create order
        $order = Order::createOrder([
            Attributes::ORDER_ID => $order_id,
            Attributes::AMOUNT => $amount,
            Attributes::CURRENCY => $currency,
            Attributes::SESSION_CREATED => (bool)$session_id,
            Attributes::SUCCESS_URL => $success_url,
            Attributes::ERROR_URL => $error_url,
            Attributes::DESCRIPTION => $description,
            Attributes::GATEWAY => PaymentGateways::CREDIMAX,
            Attributes::STATUS => PaymentStatus::PENDING,
        ]);

        if (!empty($error_message)) {
            return redirect()->to($error_url)->with('error', $error_message);
        }

        Log::info('checkout credimax');
        return view('checkout', [
            'session_id' => $session_id
        ]);
    }
}
