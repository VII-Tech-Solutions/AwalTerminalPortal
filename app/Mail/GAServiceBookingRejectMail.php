<?php

namespace App\Mail;

/**
 * class GAServiceBookingRejectMail
 * @package App\Mail
 */
class GAServiceBookingRejectMail extends RejectionMailableTemplate
{
    public function __construct($to_email, $to_name, $rejectionReason, $data)
    {
        parent::__construct($to_email, $to_name, $rejectionReason, $data, "Your General Aviation Booking Reject", "emails.general_aviation_reject_update");
    }
}
