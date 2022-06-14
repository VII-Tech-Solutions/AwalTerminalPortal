<?php

namespace App\Http\Controllers;

use App\API\Controllers\CustomController;
use App\Constants\Attributes;
use App\Constants\Values;
use App\Helpers;
use App\Mail\ContactUsMail;
use App\Mail\ESBookingStatusUpdateMail;
use App\Mail\ESNewBookingMail;
use App\Mail\ESRequestReceivedMail;
use App\Mail\GAServiceNewRequestMail;
use App\Mail\GAServiceRequestReceivedMail;
use App\Models\EliteServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use VIITech\Helpers\Constants\CastingTypes;
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

        $email = "ahmed.yusuf@viitech.net";
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
        Helpers::sendMailable(new ESBookingStatusUpdateMail($email, $to_name, []), $email);

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
     * @return
     */
    function pay(){

        // validate signature
        if(!$this->request->hasValidSignature()){
            return redirect()->to(env("WEBSITE_URL") . "/elite-form?error=true");
        }

        // get uuid
        $uuid = $this->request->get(Attributes::UUID);
        if(empty($uuid)){
            return redirect()->to(env("WEBSITE_URL") . "/elite-form?error=true");
        }

        // build url query
        $query = http_build_query([
            Attributes::RETURN_URL => "",
            Attributes::AMOUNT => "",
            Attributes::ORDER_ID => "",
            Attributes::DESCRIPTION => "",
        ]);

        dd($query);

        return redirect()->to(env("CREDIMAX_URL") . "/checkout");

    }

    /**
     * Process Payment
     * @return void
     */
    function processPayment(){
        dd($this->request->all());
    }

}
