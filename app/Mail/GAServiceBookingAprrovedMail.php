<?php

namespace App\Mail;

/**
 * class GAServiceBookingAprrovedMail
 * @package App\Mail
 */
class GAServiceBookingAprrovedMail extends MailableTemplate
{
    public function __construct($to_email, $to_name, $data)
    {
        parent::__construct($to_email, $to_name, $data, "Your General Aviation Booking Approved", "emails.general_aviation_approve");
    }
}
