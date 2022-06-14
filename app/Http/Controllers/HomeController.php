<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Mail\ContactUsMail;
use App\Mail\ESBookingStatusUpdateMail;
use App\Mail\ESNewBookingMail;
use App\Mail\ESRequestReceivedMail;
use App\Mail\GAServiceNewRequestMail;
use App\Mail\GAServiceRequestReceivedMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Home Controller
 */
class HomeController extends Controller
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
     * @return void
     */
    function process(){




        dd("aa");


    }

}
