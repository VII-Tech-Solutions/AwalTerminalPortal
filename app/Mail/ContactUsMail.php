<?php

namespace App\Mail;

/**
 * class ContactUsMail
 * @package App\Mail
 */
class ContactUsMail extends MailableTemplate
{
    public function __construct($to_email, $to_name, $data)
    {
        parent::__construct($to_email, $to_name, $data, "Awal Private Terminal: New Submission", "emails.contact_us");
    }
}
