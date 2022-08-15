<?php

namespace App\Http\Controllers;

use App\API\Controllers\CustomController;
use App\Constants\Attributes;
use App\Constants\PaymentProvider;
use App\Constants\TransactionStatus;
use App\Constants\Values;
use App\Helpers;
use App\Models\EliteServices;
use App\Models\Transaction;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use VIITech\Helpers\Constants\CastingTypes;
use VIITech\Helpers\Constants\DebuggerLevels;
use VIITech\Helpers\Constants\Platforms;
use VIITech\Helpers\GlobalHelpers;

class PaymentController extends CustomController
{


    /**
     * Redirect To
     * @param $platform
     * @param Transaction $transaction
     * @param $error
     * @return RedirectResponse
     */
    function redirectTo($platform, $transaction, $error)
    {
        $error = $error ? "true" : "false";
        if ($platform == Platforms::WEB && !is_null($transaction)) {
//            $redirect_to = env('WEBSITE_URL') . "/booking/confirmation/$transaction->uuid" .
//                "?transaction_id=$transaction->id&payment_method=$transaction->payment_provider" .
//                "&uuid=$transaction->uuid&error=$error";
            $redirect_to = env('WEBSITE_URL') . '/payment-received';

        } else if (!is_null($transaction)) {
            $redirect_to = url("/api/payments/redirect") . "?uuid=$transaction->uuid?&payment_method=$transaction->payment_provider&error=$error";
        } else {
            $redirect_to = url("/api/payments/redirect") . "?error=$error";
        }
        return redirect()->to($redirect_to);
    }


    /**
     * Verify Benefit Payment
     *
     * @return RedirectResponse
     *
     * * @OA\GET(
     *     path="/api/payments/verify-benefit",
     *     tags={"Payments"},
     *     description="Payments Verify",
     *     @OA\Response(response="200", description="Requested successfully ", @OA\JsonContent(ref="#/components/schemas/CustomJsonResponse")),
     *     @OA\Response(response="500", description="Internal Server Error", @OA\JsonContent(ref="#/components/schemas/CustomJsonResponse")),
     * )
     */
    public function verifyBenefitPayment()
    {

        $booking_uuid = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::BOOKING, null, CastingTypes::STRING);
        $secret = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::SECRET, null, CastingTypes::STRING);
        $platform = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PLATFORM, Platforms::MOBILE, CastingTypes::STRING);

        $redirect_to = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::REDIRECT_TO, null, CastingTypes::STRING);
        if (is_null($redirect_to)) {
            $redirect_to = url("/api/payments/redirect?booking=$booking_uuid");
        }

        if ($secret !== Values::SECRET) {
            return redirect()->to($redirect_to . "&error=true");
        }

        /** @var EliteServices $booking */
        $booking = EliteServices::where(Attributes::UUID, $booking_uuid)->first();
        if (is_null($booking)) {
            return redirect()->to($redirect_to . "&error=true");
        }

        /** @var Transaction $temp_order */
        $temp_order = Transaction::where(Attributes::UUID, $booking_uuid)->orderByDesc(Attributes::CREATED_AT)->first();
        if (is_null($temp_order)) {
            return redirect()->to($redirect_to . "&error=true");
        }

        $benefit_request_data = [
            Attributes::UUID => $temp_order->uuid,
            Attributes::ORDER_ID => $temp_order->uuid,
            Attributes::TRACKID => $temp_order->uuid,
            Attributes::PAYMENT_METHOD => $temp_order->payment_provider,
            Attributes::PAYMENT_SECRET => env("PAYMENT_SECRET", 'FzpTv!dEiVC_i.Cp7nQgQH-UWW63LE_tdVtUA9v4Xr!uum6tcJ'),
            Attributes::BENEFIT_MIDDLEWARE_TOKEN => env("PAYMENT_SECRET", 'FzpTv!dEiVC_i.Cp7nQgQH-UWW63LE_tdVtUA9v4Xr!uum6tcJ'),
        ];

        $url = env('PAYMENT_URL') . '/verify';

        try {
            $benefit_request_data = Helpers::array_to_multipart_array($benefit_request_data);
            $client = new Client();
            $response = $client->request('POST', $url, [
                'multipart' => $benefit_request_data,
                'http_errors' => false
            ]);

            $response_body = json_decode($response->getBody()->getContents());
            $captured = $response_body->captured ?? false;
            $has_error_message = isset($response_body->error_message);

            if ($has_error_message || !$captured) {
                $error = "true";
            } else {
                $error = "false";
            }
        } catch (Exception $e) {
            $error = "true";
            Helpers::captureException($e);
        }

        if ($platform == Platforms::WEB) {
//            $redirect_to = env('WEBSITE_URL') . "/booking/confirmation/$booking->uuid" .
//                "?booking_id=$booking->id&payment_method=$temp_order->payment_provider&payment_status=$temp_order->status" .
//                "&uuid=$booking->uuid";
            $redirect_to = env('WEBSITE_URL') . '/payment-received';
        }
        return redirect()->to($redirect_to . "&error=$error");
    }


    /**
     * Payments Redirect
     *
     * @return View
     *
     * * @OA\GET(
     *     path="/api/payments/redirect",
     *     tags={"Payments"},
     *     description="Payments Redirect",
     *     @OA\Response(response="200", description="Requested successfully ", @OA\JsonContent(ref="#/components/schemas/CustomJsonResponse")),
     *     @OA\Response(response="500", description="Internal Server Error", @OA\JsonContent(ref="#/components/schemas/CustomJsonResponse")),
     * )
     */
    public function paymentRedirect()
    {

        // change payment status of booking
        $uuid = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::UUID, null, CastingTypes::STRING);
        $error = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::ERROR, null, CastingTypes::BOOLEAN);
        $payment_method = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PAYMENT_METHOD, PaymentProvider::BENEFIT, CastingTypes::INTEGER);

        if (!is_null($error)) {
            /** @var Transaction $transaction */
            $transaction = Transaction::where(Attributes::UUID, $uuid)->first();
            if (!is_null($transaction)) {
                if (!$error) {
                    $transaction->status = TransactionStatus::SUCCESS;
                } else {
                    $transaction->status = TransactionStatus::FAIL;
                }
                if (is_null($transaction->payment_provider)) {
                    $transaction->payment_provider = $payment_method;
                }

                $transaction->save();
            }
        }

        return view('payment');
    }


    /**
     * Generate Benefit Payment Link
     * @return string
     */
    static function generateBenefitPaymentLink($amount, $uid, $customer_name, $customer_phone_number, $success_url, $error_url)
    {

        try {

            // and will call the benefit middle ware on this case to generate a payment page url
            $benefit_request_data = [
                Attributes::AMOUNT => $amount,
                Attributes::ORDER_ID => $uid,
                Attributes::TRACKID => $uid,
                Attributes::CUSTOMER_NAME => $customer_name,
                Attributes::CUSTOMER_PHONE_NUMBER => $customer_phone_number,
                Attributes::PAYMENT_SECRET => env("PAYMENT_SECRET", 'FzpTv!dEiVC_i.Cp7nQgQH-UWW63LE_tdVtUA9v4Xr!uum6tcJ'),
                Attributes::BENEFIT_MIDDLEWARE_TOKEN => env("PAYMENT_SECRET", 'FzpTv!dEiVC_i.Cp7nQgQH-UWW63LE_tdVtUA9v4Xr!uum6tcJ'),
                Attributes::SUCCESS_URL => $success_url,
                Attributes::ERROR_URL => $error_url,
//                Attributes::MERCHANT_ID => "711150801"
                Attributes::MERCHANT_ID => env("BENEFIT_MERCHANT_ID", "711150801")
//                Attributes::MERCHANT_ID => env("BENEFIT_MERCHANT_ID", "12818950")
            ];

            $benefit_request_data = Helpers::array_to_multipart_array($benefit_request_data);

            $url = env('PAYMENT_URL') . '/benefit/checkout';

            $client = new Client(['auth' => ['b4bh', 'password']]);
            $response = $client->request('POST', $url, [
                'multipart' => $benefit_request_data
            ]);

            $response_body = json_decode($response->getBody()->getContents());

            return $response_body->data->payment_page ?? null;

        } catch (Exception|GuzzleException $e) {
            Helpers::captureException($e);
        }

        return null;
    }
}
