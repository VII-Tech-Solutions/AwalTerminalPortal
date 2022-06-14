<?php

namespace App\Mail;

/**
 * class GAServiceNewRequestMail
 * @package App\Mail
 */
class GAServiceNewRequestMail extends MailableTemplate
{
    public function __construct($data)
    {
        parent::__construct(env("ADMIN_EMAIL"), env("ADMIN_NAME"), $data, "General Aviation: New Request", "emails.ga_service_new_request");
    }
}
