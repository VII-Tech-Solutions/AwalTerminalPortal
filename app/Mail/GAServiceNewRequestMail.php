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
        parent::__construct(env("ADMIN_EMAIL"), env("ADMIN_NAME"), $data, "New General Aviation Request", "emails.ga_service_new_request");
    }
}
