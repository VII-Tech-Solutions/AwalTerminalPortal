<?php

namespace App\Helpers;

use App\Constants\Attributes;
use App\Constants\Values;
use App\Helpers;
use GuzzleHttp\Client;
use VIITech\Helpers\Constants\DebuggerLevels;
use VIITech\Helpers\GlobalHelpers;

/**
 * Benefit Payment Helper
 */
class BenefitPaymentHelper
{

    /**
     * Generate Payment Link
     * @return array
     */
    static function generatePaymentLink($data){

        $payment_url = null;

        $customer_name = $data->get(Attributes::CUSTOMER_NAME);
        $customer_phone_number = $data->get(Attributes::CUSTOMER_PHONE_NUMBER);
        $amount = $data->get(Attributes::AMOUNT);
        $transaction_uid = $data->get(Attributes::TRANSACTION_UUID);

        // set to 0.001 for testing purposes
        if(GlobalHelpers::isDevelopmentEnv()){
            $amount = Values::TEST_AMOUNT;
        }

        $success_url = url("success");
        $error_url = url("fail");

        // and will call the benefit middle ware on this case to generate a payment page url
        $benefit_request_data = [
            'amount'                   => $amount,
            'trackid'                  => $transaction_uid,
            'customer_name'            => $customer_name,
            'customer_phone_number'    => $customer_phone_number,
            'benefit_middleware_token' => 'FzpTv!dEiVC_i.Cp7nQgQH-UWW63LE_tdVtUA9v4Xr!uum6tcJ',
            'success_url'              => $success_url,
            'error_url'                => $error_url,
            'merchant_id'              => '12818950'
        ];

        $benefit_request_data  = Helpers::array_to_multipart_array( $benefit_request_data );

        $client   = new Client(['auth' => ['awal', 'password']]);
        $response = $client->request( 'POST', env('PAYMENT_URL').'/elite-service-payment', [
            'multipart' => $benefit_request_data
        ] );

        $response_body = json_decode( $response->getBody()->getContents() );

        GlobalHelpers::debugger(json_encode($response_body), DebuggerLevels::INFO);

        $payment_url = $response_body->data->payment_page ?? null;

        return $payment_url;

    }

}
