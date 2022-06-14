<?php

namespace App\Mail;

/**
 * class GAServiceNewRequestMail
 * @package App\Mail
 */
class GAServiceNewRequestMail extends MailableTemplate
{
    public function __construct($to_email, $to_name, $data)
    {
        parent::__construct($to_email, $to_name, $data, "General Aviation: New Request", "emails.ga_service_new_request");
    }
}
