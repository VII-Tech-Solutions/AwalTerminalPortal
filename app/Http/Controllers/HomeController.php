<?php

namespace App\Http\Controllers;

use App\API\Controllers\CustomController;
use App\Constants\Attributes;
use App\Constants\PaymentProvider;
use App\Constants\TransactionStatus;
use App\Constants\Values;
use App\Helpers;
use App\Mail\ContactUsMail;
use App\Mail\ESBookingRejectUpdateMail;
use App\Mail\ESNewBookingMail;
use App\Mail\ESRequestReceivedMail;
use App\Mail\GAServiceNewRequestMail;
use App\Mail\GAServiceRequestReceivedMail;
use App\Models\EliteServices;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    /**
     * Process
     * @return RedirectResponse
     */
    function process()
    {

        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::query()->orderByDesc(Attributes::CREATED_AT)->first();
        // generate payment link
        $link = $elite_service->generatePaymentLink();

        // redirect to
        return redirect()->to($link);

    }

    /**
     * Pay
     * @param Request $request
     * @param $uuid
     * @return RedirectResponse
     */
    function pay(Request $request, $uuid)
    {

        if (empty($uuid)) {
            return redirect()->to(env("WEBSITE_URL") . "/expired");
        }

        // validate signature
        if (!$request->hasValidSignature()) {
            return redirect()->to(env("WEBSITE_URL") . "/expired");
        }

        // get elite service
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::where(Attributes::UUID, $uuid)->first();
        if (is_null($elite_service)) {
            return redirect()->to(env("WEBSITE_URL") . "/expired");
        }

        // get transaction
        $transaction = Transaction::createOrUpdate([
            Attributes::ELITE_SERVICE_ID => $elite_service->id,
            Attributes::AMOUNT => Values::TEST_AMOUNT,
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
        switch ($payment_method){
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
            return redirect()->to(env("WEBSITE_URL") . "/expired");
        }

        // get elite service
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::where(Attributes::UUID, $uuid)->first();
        if (is_null($elite_service)) {
            return redirect()->to(env("WEBSITE_URL") . "/expired");
        }

        // get transaction
        /** @var Transaction $transaction */
        $transaction = Transaction::where(Attributes::ELITE_SERVICE_ID, $elite_service->id)->first();
        if (is_null($transaction)) {
            return redirect()->to(env("WEBSITE_URL") . "/expired");
        }

        // TODO if $payment_method benefit, switch to benefit

        // build url query
        $query = http_build_query([
            Attributes::RETURN_URL => url("elite-service/pay/process"),
            Attributes::AMOUNT => $transaction->amount,
            Attributes::ORDER_ID => $transaction->order_id,
            Attributes::DESCRIPTION => "Awal Private Terminal Elite Services",
        ]);

        // go to payment page
        return redirect()->to(env("CREDIMAX_URL") . "/checkout?$query");
    }
}
