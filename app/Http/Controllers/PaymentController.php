<?php

namespace App\Http\Controllers;

use App\API\Controllers\CustomController;
use App\Constants\Attributes;
use App\Constants\PaymentProvider;
use App\Constants\TransactionStatus;
use App\Constants\Values;
use App\Helpers;
use App\Mail\PaymentCompleted;
use App\Models\Bookers;
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
        if ($platform == Platforms::WEB && !is_null($transaction) && $error == 'false') {
            $elite_service = EliteServices::query()->find($transaction->elite_service_id);
            $transaction->status = TransactionStatus::SUCCESS;
            $transaction->save();
            $elite_service->markAsPaid();

            // send email
            $redirect_to = env('WEBSITE_URL') . '/payment-received?uuid=' . $transaction->uuid;

        } else if (!is_null($transaction) && $transaction->status == TransactionStatus::FAIL || $error == 'true') {
            $redirect_to = env('WEBSITE_URL') . '/payment-failed';
        } else {
            $redirect_to = env('WEBSITE_URL') . '/elite-service?uuid=' . $transaction->uuid;
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

        // log request
        if (env("DEBUGGER_LOGS_ENABLED", false)) {
            GlobalHelpers::logRequest($this->request, "PaymentController@verifyBenefitPayment");
        }

        $booking_uuid = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::BOOKING, null, CastingTypes::STRING);
        $secret = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::SECRET, null, CastingTypes::STRING);
        $platform = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PLATFORM, Platforms::MOBILE, CastingTypes::STRING);
        $redirect_to = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::REDIRECT_TO, null, CastingTypes::STRING);
        $error = false;
        if (is_null($redirect_to)) {
            $redirect_to = env('WEBSITE_URL') . '/elite-service?uuid=' . $booking_uuid;
        }

        if ($secret !== Values::SECRET) {
            return redirect()->to($redirect_to . "&error=true");
        }

        /** @var EliteServices $booking */
        $booking = EliteServices::where(Attributes::UUID, $booking_uuid)->first();
        GlobalHelpers::debugger("Booking", DebuggerLevels::INFO);
        GlobalHelpers::debugger($booking, DebuggerLevels::INFO);
        if (is_null($booking)) {
            return redirect()->to($redirect_to . "&error=true");
        }

        /** @var Transaction $temp_order */
        $temp_order = Transaction::where(Attributes::UUID, $booking_uuid)->orderByDesc(Attributes::CREATED_AT)->first();
        GlobalHelpers::debugger("temp order", DebuggerLevels::INFO);
        GlobalHelpers::debugger($temp_order, DebuggerLevels::INFO);
        if (is_null($temp_order)) {
            return redirect()->to($redirect_to . "&error=true");
        }

        $benefit_request_data = [
            Attributes::UUID => $temp_order->uuid,
            Attributes::ORDER_ID => $temp_order->uuid,
            Attributes::TRACKID => $temp_order->uuid,
            Attributes::PAYMENT_METHOD => $temp_order->payment_provider,
            Attributes::PAYMENT_SECRET => env("PAYMENT_SECRET"),
            Attributes::BENEFIT_MIDDLEWARE_TOKEN => env("PAYMENT_SECRET"),
        ];

        $url = env('APP_URL') . '/api/benefit/verify';

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
            Helpers::captureException($e);
            dd($e);
            $redirect_to = env('WEBSITE_URL') . '/payment-failed';
        } catch (GuzzleException $e) {
            dd($e);
            $redirect_to = env('WEBSITE_URL') . '/payment-failed';
        }

        if ($platform == Platforms::WEB) {
            if ($error) {
                $redirect_to = env('WEBSITE_URL') . '/payment-failed';
                dd($error);
            } else {
                $temp_order->status = TransactionStatus::SUCCESS;
                $temp_order->save();
                $elite_service = EliteServices::query()->find($temp_order->elite_service_id);
                $elite_service->markAsPaid();
                $redirect_to = env('WEBSITE_URL') . '/payment-received?uuid=' . $temp_order->uuid;
            }
        }

        return redirect()->to($redirect_to);
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
    static function generateBenefitPaymentLink($amount, $uid, $customer_name, $customer_phone_number, $success_url, $error_url, $order_id)
    {

        try {

            // and will call the benefit middle ware on this case to generate a payment page url
            $benefit_request_data = [
                Attributes::AMOUNT => $amount,
                Attributes::ORDER_ID => $order_id,
                Attributes::TRACKID => $uid,
                Attributes::CUSTOMER_NAME => $customer_name,
                Attributes::CUSTOMER_PHONE_NUMBER => str_replace("+", "00", $customer_phone_number),
                Attributes::PAYMENT_SECRET => env("PAYMENT_SECRET"),
                Attributes::BENEFIT_MIDDLEWARE_TOKEN => env("PAYMENT_SECRET"),
                Attributes::SUCCESS_URL => $success_url,
                Attributes::ERROR_URL => $error_url,
                Attributes::MERCHANT_ID => env("BENEFIT_MERCHANT_ID"),
                Attributes::DESCRIPTION => "test"
            ];

            return BenefitsController::checkout($benefit_request_data);

        } catch (Exception|GuzzleException $e) {
            Helpers::captureException($e);
            dd($e);
        }

        return null;
    }

    public function verifyCredimaxPayment()
    {

        // get values
        $secret = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::SECRET, null, CastingTypes::STRING);
        $success = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::SUCCESS, false, CastingTypes::BOOLEAN);
        $booking_uuid = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::BOOKING, null, CastingTypes::STRING);
        $platform = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PLATFORM, Platforms::MOBILE, CastingTypes::STRING);

        if (empty($booking_uuid)) {
            $booking_uuid = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::UUID, null, CastingTypes::STRING);
        }

        /** @var EliteServices $booking */
        $booking = EliteServices::where(Attributes::UUID, $booking_uuid)->first();
        if (is_null($booking)) {
            return $this->redirectTo($platform, null, true);
        }

        /** @var Transaction $temp_order */
        $temp_order = Transaction::where(Attributes::UUID, $booking_uuid)->orderByDesc(Attributes::CREATED_AT)->first();
        if (is_null($temp_order)) {
            return $this->redirectTo($platform, $temp_order, true);
        }

        if (!$success || $secret !== Values::SECRET) {
            return $this->redirectTo($platform, $temp_order, true);
        }

        return $this->redirectTo($platform, $temp_order, false);
    }
}
