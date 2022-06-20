<?php

namespace App\Mail;

/**
 * class ESBookingRejectUpdateMail
 * @package App\Mail
 */
class ESBookingRejectUpdateMail extends RejectionMailableTemplate
{
    public function __construct($to_email, $to_name, $rejectionReason, $data)
    {
        parent::__construct($to_email, $to_name, $rejectionReason, $data, "Your Elite Service Booking Request", "emails.elite_service_reject_update");
    }
}
