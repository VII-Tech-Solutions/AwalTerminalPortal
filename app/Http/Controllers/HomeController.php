<?php

namespace App\Http\Controllers;

use App\API\Controllers\CustomController;
use App\Constants\Attributes;
use App\Constants\PaymentProvider;
use App\Constants\TransactionStatus;
use App\Constants\Values;
use App\Helpers;
use App\Mail\ContactUsMail;
use App\Mail\ESBookingApproveMail;
use App\Mail\ESBookingRejectUpdateMail;
use App\Mail\ESNewBookingMail;
use App\Mail\ESRequestReceivedMail;
use App\Mail\GAServiceBookingAprrovedMail;
use App\Mail\GAServiceBookingRejectMail;
use App\Mail\GAServiceNewRequestMail;
use App\Mail\GAServiceRequestReceivedMail;
use App\Models\Bookers;
use App\Models\EliteServices;
use App\Models\GeneralAviationServices;
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
     * Emails
     * @return void
     */
    function emails()
    {

        $email = "fatima.zuhair@viitech.net";
        $to_name = "Ahmed Yusuf";

        // Contact Us - To Admin
        Helpers::sendMailable(new ContactUsMail($email, $to_name, []), $email);

        // GA Request - To Customer
        Helpers::sendMailable(new GAServiceRequestReceivedMail($email, $to_name, []), $email);

        // GA Request - To Admin
        Helpers::sendMailable(new GAServiceNewRequestMail([]), $email);

        // Elite Service New Booking - To Admin
        Helpers::sendMailable(new ESNewBookingMail([]), $email);

        // Elite Service New Booking - To Customer
        Helpers::sendMailable(new ESRequestReceivedMail($email, $to_name, []), $email);

        // Elite Service Status Update - To Customer
        Helpers::sendMailable(new ESBookingRejectUpdateMail($email, $to_name, []), $email);

    }


    /**
     * Process
     * @return
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
     * @return RedirectResponse
     */
    function pay(Request $request)
    {

        $uuid = $request->get(Attributes::UUID);
        if (empty($uuid)) {
            return redirect()->to(env("WEBSITE_URL") . "expired");
        }

        // validate signature
        if (!$request->hasValidSignature()) {
            return redirect()->to(env("WEBSITE_URL") . "expired");
        }

        // get elite service
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::where(Attributes::UUID, $uuid)->first();
        if (is_null($elite_service)) {
            return redirect()->to(env("WEBSITE_URL") . "expired");
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

//        dd(env("WEBSITE_URL") . "elite-payement-form?uuid=$elite_service->uuid&secret=atp");

        // redirect to page
        return redirect()->to(env("WEBSITE_URL") . "payment-recevied");


//        // build url query
//        $query = http_build_query([
//            Attributes::RETURN_URL => url("elite-service/pay/process"),
//            Attributes::AMOUNT => $transaction->amount,
//            Attributes::ORDER_ID => $transaction->order_id,
//            Attributes::DESCRIPTION => "Awal Private Terminal Elite Services",
//        ]);


        // go to payment page
//        return redirect()->to(env("CREDIMAX_URL") . "/checkout?$query");

    }

    /**
     * Process Payment
     * @return void
     */
    function processPayment(Request $request)
    {
        dd($request->all());
    }


    // General Aviation emails

    function generalAviationSubmission()
    {
        $general_aviation = GeneralAviationServices::query()->where(Attributes::ID, '1')->first();
        $operator_full_name = $general_aviation->operator_full_name;
        $agent_fullname = $general_aviation->agent_fullname;
        $operator_email = $general_aviation->operator_email;
        Helpers::sendMailable(new GAServiceRequestReceivedMail($operator_email, $operator_full_name, [$agent_fullname]), $operator_email);
    }


    function generalAviationReject()
    {
        $general_aviation = GeneralAviationServices::query()->where(Attributes::ID, '1')->first();
        $operator_full_name = $general_aviation->operator_full_name;
        $agent_fullname = $general_aviation->agent_fullname;
        $operator_email = $general_aviation->operator_email;
        Helpers::sendMailable(new GAServiceBookingRejectMail($operator_email, $operator_full_name, [$agent_fullname]), $operator_email);

    }


    function generalAviationApprove()
    {
        $general_aviation = GeneralAviationServices::query()->where(Attributes::ID, '1')->first();
        $operator_full_name = $general_aviation->operator_full_name;
        $agent_fullname = $general_aviation->agent_fullname;
        $operator_email = $general_aviation->operator_email;
        Helpers::sendMailable(new GAServiceBookingAprrovedMail($operator_email, $operator_full_name, [$agent_fullname]), $operator_email);
    }

    /**
     * Booking Submission
     * @return void
     */
    function bookingSubmission()
    {
        $elite_service = EliteServices::query()->where(Attributes::ID, '10')->first();
        $user = Bookers::query()->where(Attributes::ID, $elite_service->id)->first();
        Helpers::sendMailable(new ESRequestReceivedMail($user->email, $user->first_name, []), $user->emaill);
    }

    /**
     * Reject Submission
     * @param $id
     * @return void
     */
    function rejectSubmission($id)
    {
        $elite_service = EliteServices::query()->where(Attributes::ID, $id)->first();
        $user = Bookers::query()->where(Attributes::ID, $elite_service->id)->first();
        Helpers::sendMailable(new ESBookingRejectUpdateMail($user->email, $user->first_name, []), $user->email);
    }

    /**
     * Approve Submission
     * @return void
     */
    function approveSubmission()
    {
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::query()->where(Attributes::ID, '10')->first();
        $user = Bookers::query()->where(Attributes::ID, $elite_service->id)->first();
        $link = $elite_service->generatePaymentLink($elite_service->uuid);
        Helpers::sendMailable(new ESBookingApproveMail($user->email, $user->first_name, [$link]), $user->email);
    }


}
