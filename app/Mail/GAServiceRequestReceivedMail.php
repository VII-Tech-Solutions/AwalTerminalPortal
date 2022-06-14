<?php

namespace App\Mail;

/**
 * class GAServiceRequestReceivedMail
 * @package App\Mail
 */
class GAServiceRequestReceivedMail extends MailableTemplate
{
    public function __construct($to_email, $to_name, $data)
    {
        parent::__construct($to_email, $to_name, $data, "General Aviation Request", "emails.ga_request_received");
    }
}
