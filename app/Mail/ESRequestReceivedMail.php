<?php

namespace App\Mail;

/**
 * class ESRequestReceivedMail
 * @package App\Mail
 */
class ESRequestReceivedMail extends MailableTemplate
{
    public function __construct($to_email, $to_name, $data)
    {
        parent::__construct($to_email, $to_name, $data, "Elite Service Booking", "emails.elite_service_request_received");
    }
}
