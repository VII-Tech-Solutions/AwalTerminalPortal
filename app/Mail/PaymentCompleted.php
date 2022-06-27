<?php

namespace App\Mail;

/**
 * Class PaymentCompleted
 * @package App\Mail
 */
class PaymentCompleted extends MailableTemplate
{
    public function __construct($to_email, $to_name, $data, $attachment)
    {
        parent::__construct($to_email, $to_name, $data, "Payment Completed", "emails.payment_completed", $attachment);
    }
}
