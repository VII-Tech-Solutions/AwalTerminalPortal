<?php

namespace App\Mail;

/**
 * class ContactUsMail
 * @package App\Mail
 */
class ContactUsMail extends MailableTemplate
{
    public function __construct($data)
    {
        parent::__construct(env("ADMIN_EMAIL"), env("ADMIN_NAME"), $data, "Awal Private Terminal: New Submission", "emails.contact_us");
    }
}
