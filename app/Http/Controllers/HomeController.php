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
use App\Mail\GAServiceNewRequestMail;
use App\Mail\GAServiceRequestReceivedMail;
use App\Models\Bookers;
use App\Models\EliteServices;
use App\Models\Transaction;
use App\Models\User;
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
    function welcome(){
        return view('welcome');
    }

    /**
     * Home
     * @return RedirectResponse
     */
    function home(){
        return redirect()->to("/");
    }

    /**
     * Emails
     * @return void
     */
    function emails(){

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
    function process(){

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
    function pay(Request $request){

        $uuid = $request->get(Attributes::UUID);
        if(empty($uuid)){
            return redirect()->to(env("WEBSITE_URL") . "expired");
        }

        // validate signature
        if(!$request->hasValidSignature()){
            return redirect()->to(env("WEBSITE_URL") . "expired");
        }

        // get elite service
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::where(Attributes::UUID, $uuid)->first();
        if(is_null($elite_service)){
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

        dd(env("WEBSITE_URL") . "elite-payement-form?uuid=$elite_service->uuid&secret=atp");

        // redirect to page
        return redirect()->to(env("WEBSITE_URL") . "elite-payement-form?uuid=$elite_service->uuid&secret=atp");



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
    function processPayment(Request $request){
        dd($request->all());
    }








    function generalAviationSubmission(){
        $general_aviation = EliteServices::query()->where(Attributes::ID,'10')->first();
        $user = Bookers::query()->where(Attributes::ID,$general_aviation->id)->first();
        Helpers::sendMailable(new ESRequestReceivedMail($user->email, $user->first_name, []), $user->emaill);
    }



    function generalAviationReject(){
        $general_aviation = EliteServices::query()->where(Attributes::ID,'10')->first();
        $user = Bookers::query()->where(Attributes::ID,$general_aviation->id)->first();
        $number = 'BH101';
//         get transaction
        $elite = EliteServices::createOrUpdate([
            Attributes::SERVICE_ID => $general_aviation->id,
            Attributes::UUID => $general_aviation->uuid,
        ], [
            Attributes::FLIGHT_NUMBER => $general_aviation->id,
        ]);

        dd($elite);
        Helpers::sendMailable(new ESBookingRejectUpdateMail($user->email, $user->first_name, []), $user->email);

    }



    function generalAviationApprove(){
        $general_aviation = EliteServices::query()->where(Attributes::ID,'10')->first();
        $user = Bookers::query()->where(Attributes::ID,$general_aviation->id)->first();
        $link = $general_aviation->generatePaymentLink($general_aviation->uuid);
        Helpers::sendMailable(new ESBookingApproveMail($user->email, $user->first_name, [$link]), $user->email);
    }




    function bookingSubmission(){
        $elite_service = EliteServices::query()->where(Attributes::ID,'10')->first();
        dd($elite_service->amount);
        $user = Bookers::query()->where(Attributes::ID,$elite_service->id)->first();
        Helpers::sendMailable(new ESRequestReceivedMail($user->email, $user->first_name, []), $user->emaill);
    }




    function rejectSubmission(){
        $elite_service = EliteServices::query()->where(Attributes::ID,'10')->first();
        $user = Bookers::query()->where(Attributes::ID,$elite_service->id)->first();
        $number = 'BH101';
//         get transaction
        $elite = EliteServices::createOrUpdate([
            Attributes::SERVICE_ID => $elite_service->id,
            Attributes::UUID => $elite_service->uuid,
        ], [
            Attributes::FLIGHT_NUMBER => $elite_service->id,
        ]);

dd($elite);
        Helpers::sendMailable(new ESBookingRejectUpdateMail($user->email, $user->first_name, []), $user->email);

    }

    function approveSubmission(){
        $elite_service = EliteServices::query()->where(Attributes::ID,'10')->first();
        $user = Bookers::query()->where(Attributes::ID,$elite_service->id)->first();
        $link = $elite_service->generatePaymentLink($elite_service->uuid);
        Helpers::sendMailable(new ESBookingApproveMail($user->email, $user->first_name, [$link]), $user->email);
    }

    function validatePaymentLink(){

    }

    function completePayment(){

    }

}
