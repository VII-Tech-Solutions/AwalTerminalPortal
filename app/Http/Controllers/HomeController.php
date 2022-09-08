<?php

namespace App\Http\Controllers;

use App\API\Controllers\CustomController;
use App\Constants\Attributes;
use App\Constants\CastingTypes;
use App\Constants\PaymentProvider;
use App\Constants\TransactionStatus;
use App\Helpers;
use App\Models\EliteServices;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use VIITech\Helpers\GlobalHelpers;

/**
 * Home Controller
 */
class HomeController extends CustomController
{

    /**
     * Welcome
     * @return View
     */
    function welcome()
    {
        return view('welcome');
    }

    /**
     * Home
     * @return RedirectResponse
     */
    function home()
    {
        return redirect()->to("/");
    }

//    /**
//     * Process
//     * @return RedirectResponse
//     */
//    function process()
//    {
//
//        /** @var EliteServices $elite_service */
//        $elite_service = EliteServices::query()->orderByDesc(Attributes::CREATED_AT)->first();
//        // generate payment link
//        $link = $elite_service->generatePaymentLink();
//
//        // redirect to
//        return redirect()->to($link);
//
//    }

    /**
     * Pay
     * @param Request $request
     * @param $uuid
     * @return RedirectResponse
     */
    function pay(Request $request, $uuid)
    {

        if (empty($uuid)) {
            return redirect()->to(env("WEBSITE_URL") . "/link-expired");
        }

        // validate signature
        if (!$request->hasValidSignature()) {
            return redirect()->to(env("WEBSITE_URL") . "/link-expired");
        }

        // get elite service
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::where(Attributes::UUID, $uuid)->first();
        if (is_null($elite_service)) {
            return redirect()->to(env("WEBSITE_URL") . "/link-expired");
        }

        // get transaction
        Transaction::createOrUpdate([
            Attributes::ELITE_SERVICE_ID => $elite_service->id,
            Attributes::AMOUNT => $elite_service->total,
            Attributes::ORDER_ID => Helpers::generateOrderID(new Transaction(), Attributes::ORDER_ID),
            Attributes::PAYMENT_PROVIDER => PaymentProvider::CREDIMAX,
            Attributes::UUID => $elite_service->uuid,
            Attributes::STATUS => TransactionStatus::PENDING
        ], [
            Attributes::ELITE_SERVICE_ID,
            Attributes::UUID,
            Attributes::AMOUNT,
        ]);

        // redirect to page
        return redirect()->to(url("/elite-service/$uuid/pay/process"));
    }

    /**
     * Process Payment
     * @param Request $request
     * @param $uuid
     * @return RedirectResponse
     */
    function processPayment(Request $request, $uuid)
    {

        // get payment method
        $payment_method = $request->get(Attributes::PAYMENT_METHOD);
        switch ($payment_method) {
            case PaymentProvider::CREDIMAX:
            default:
                $payment_method = PaymentProvider::CREDIMAX;
                break;
            case PaymentProvider::BENEFIT:
                $payment_method = PaymentProvider::BENEFIT;
                break;
        }

        // get uuid
        if (empty($uuid)) {
            return redirect()->to(env("WEBSITE_URL") . "/link-expired");
        }

        // get elite service
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::where(Attributes::UUID, $uuid)->first();
        if (is_null($elite_service)) {
            return redirect()->to(env("WEBSITE_URL") . "/link-expired");
        }

        // create transaction
        $transaction = Transaction::createOrUpdate([
            Attributes::ELITE_SERVICE_ID => $elite_service->id,
            Attributes::AMOUNT => $elite_service->total,
            Attributes::ORDER_ID => Helpers::generateOrderID(new Transaction(), Attributes::ORDER_ID),
            Attributes::PAYMENT_PROVIDER => $payment_method,
            Attributes::UUID => $elite_service->uuid,
            Attributes::STATUS => TransactionStatus::PENDING
        ], [
            Attributes::UUID,
            Attributes::AMOUNT
        ]);

        if (is_null($transaction->order_id)) {
            $transaction->order_id = Helpers::generateOrderID(new Transaction(), Attributes::ORDER_ID);
            $transaction->save();
        }


        // redirect to payment gateway
        if ($payment_method == PaymentProvider::CREDIMAX) {
            // build url query
            $query = http_build_query([
                Attributes::RETURN_URL => url("elite-service/$uuid/pay/complete"),
                Attributes::AMOUNT => $transaction->amount,
                Attributes::ORDER_ID => $transaction->uuid,
                Attributes::TRANSACTION_ORDER_ID => $transaction->order_id,
                Attributes::DESCRIPTION => "Awal Private Terminal Elite Services",
            ]);

            // go to payment page
            return redirect()->to(env("CREDIMAX_URL") . "/checkout?$query");

        } else if ($payment_method == PaymentProvider::BENEFIT) {

            $secret = env("PAYMENT_SECRET", 'FzpTv!dEiVC_i.Cp7nQgQH-UWW63LE_tdVtUA9v4Xr!uum6tcJ');

            $success_url = url("/api/payments/verify-benefit?booking=$transaction->uuid&secret=$secret&platform=web");
            $error_url = url("/api/payments/verify-benefit?booking=$transaction->uuid&secret=$secret&platform=web");

            $booker = $elite_service->booker()->first();

            $name = $booker->first_name . " " . $booker->last_name;
            $phoneNumber = $booker->mobile_number;

            // go to payment page
            $payment_url = PaymentController::generateBenefitPaymentLink($transaction->amount, $elite_service->uuid, $name, $phoneNumber, $success_url, $error_url, $transaction->order_id);
            return redirect()->to($payment_url);
        }


        // redirect to link expired
        return redirect()->to(env("WEBSITE_URL") . "/link-expired");

    }




//
//    /**
//     * Complete Payment
//     * @param Request $request
//     * @param $uuid
//     * @return RedirectResponse
//     */
//    function completePayment(Request $request, $uuid)
//    {
//        // get elite service
//        /** @var EliteServices $elite_service */
//        $elite_service = EliteServices::where(Attributes::UUID, $uuid)->first();
//        if (is_null($elite_service)) {
//            return redirect()->to(env("WEBSITE_URL") . "/payment-failed");
//        }
//
//        // get values
//        $success = GlobalHelpers::getValueFromHTTPRequest($request, Attributes::SUCCESS, false, CastingTypes::BOOLEAN);
////        $uuid = GlobalHelpers::getValueFromHTTPRequest($request, Attributes::UUID, false, CastingTypes::STRING);
//
//        // get transaction
//        $transaction = Transaction::where(Attributes::UUID, $uuid)->where(Attributes::ELITE_SERVICE_ID, $elite_service->id)->first();
//        if (is_null($transaction)) {
//            return redirect()->to(env("WEBSITE_URL") . "/payment-failed");
//        }
//
//        // update transaction status
//        $transaction->status = true;
//        $transaction->save();
//
//        // update elite service
//        $elite_service->markAsPaid();
//
//        // return response
//        return redirect()->to(env("WEBSITE_URL") . "/payment-received");
//
//    }

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
        $uuid = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::BOOKING, null, CastingTypes::STRING);
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

}
