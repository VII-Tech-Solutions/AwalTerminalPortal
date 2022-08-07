<?php

namespace App\Http\Controllers;

use App\API\Controllers\CustomController;
use App\Constants\ActivityPaymentMethods;
use App\Constants\Attributes;
use App\Constants\PaymentProvider;
use App\Constants\PaymentStatus;
use App\Constants\TransactionStatus;
use App\Constants\Values;
use App\Helpers;
use App\Models\ActivityBooking;
use App\Models\EliteServices;
use App\Models\Transaction;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use VIITech\Helpers\Constants\CastingTypes;
use VIITech\Helpers\Constants\Platforms;
use VIITech\Helpers\GlobalHelpers;

class PaymentController extends CustomController
{


    /**
     * Redirect To
     * @param $platform
     * @param Transaction $booking
     * @param $error
     * @return RedirectResponse
     */
    function redirectTo($platform, $booking, $error)
    {
        $error = $error ? "true" : "false";
        if ($platform == Platforms::WEB && !is_null($booking)) {
            $redirect_to = env('WEBSITE_URL') . "/payment-failed";
        } else if (!is_null($booking)) {
            $redirect_to = url("/api/payments/redirect") . "?booking=$booking->uuid&error=$error";
        } else {
            $redirect_to = env('WEBSITE_URL') . "/payment-failed";
        }
        return redirect()->to($redirect_to);
    }



    /**
     * Verify Benefit Payment
     *
     * @return RedirectResponse
     *
     * * @OA\GET(
     *     path="/api/payments/verify",
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
            Attributes::PAYMENT_PROVIDER => $temp_order->payment_provider,
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
            $redirect_to = env('WEBSITE_URL') . "/payment-received";
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
        $booking_uuid = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::BOOKING, null, CastingTypes::STRING);
        $error = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::ERROR, null, CastingTypes::BOOLEAN);
        $payment_method = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PAYMENT_METHOD, ActivityPaymentMethods::DEBIT_CARD, CastingTypes::INTEGER);
        if(!is_null($error)){
            /** @var Transaction $booking */
            $booking = Transaction::where(Attributes::UUID, $booking_uuid)->first();
            if(!is_null($booking)){
                if(!$error){
                    $booking->status = TransactionStatus::SUCCESS;
                }else{
                    $booking->status = TransactionStatus::FAIL;
                }
                if(is_null($booking->payment_provider)){
                    $booking->payment_provider = $payment_method;
                }

                $booking->save();
            }
        }

        return view('payment');
    }

}
