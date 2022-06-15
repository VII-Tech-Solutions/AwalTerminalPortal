<?php

namespace App\Mail;

/**
 * class ESBookingRejectUpdateMail
 * @package App\Mail
 */
class ESBookingRejectUpdateMail extends MailableTemplate
{
    public function __construct($to_email, $to_name, $data)
    {
        parent::__construct($to_email, $to_name, $data, "Your Elite Service Booking Request", "emails.elite_service_reject_update");
    }
}
