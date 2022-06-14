<?php

namespace App\Mail;

/**
 * class ESBookingStatusUpdateMail
 * @package App\Mail
 */
class ESBookingStatusUpdateMail extends MailableTemplate
{
    public function __construct($to_email, $to_name, $data)
    {
        parent::__construct($to_email, $to_name, $data, "Your Elite Service Booking Request", "emails.elite_service_status_update");
    }
}
