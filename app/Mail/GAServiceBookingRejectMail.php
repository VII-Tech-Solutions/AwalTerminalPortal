<?php

namespace App\Mail;

/**
 * class GAServiceBookingRejectMail
 * @package App\Mail
 */
class GAServiceBookingRejectMail extends MailableTemplate
{
    public function __construct($to_email, $to_name, $data)
    {
        parent::__construct($to_email, $to_name, $data, "Your General Aviation Booking Reject", "emails.general_aviation_reject_update");
    }
}
