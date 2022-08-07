<?php

namespace App\Mail;

/**
 * Class PaymentCompleted
 * @package App\Mail
 */
class PaymentCompleted extends AttachmentMailableTemplate
{
    public function __construct($to_email, $to_name, $data, $attachment, $transaction_id, $receipt)
    {
        parent::__construct($to_email, $to_name, $data, "Your Elite Service Booking Request", "emails.payment_completed", $attachment, $transaction_id, $receipt);
    }
}
