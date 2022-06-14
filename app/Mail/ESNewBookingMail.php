<?php

namespace App\Mail;

/**
 * class EliteServiceBookingMail
 * @package App\Mail
 */
class ESNewBookingMail extends MailableTemplate
{
    public function __construct($to_email, $to_name, $data)
    {
        parent::__construct($to_email, $to_name, $data, "Elite Service: New Booking", "emails.elite_service_new_booking");
    }
}
