<?php

namespace App\Mail;

/**
 * class EliteServiceBookingMail
 * @package App\Mail
 */
class ESNewBookingMail extends MailableTemplate
{
    public function __construct($data)
    {
        parent::__construct(env("ADMIN_EMAIL"), env("ADMIN_NAME"), $data, "Awal Private Terminal: New Booking", "emails.elite_service_new_booking");
    }
}
