<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class TestMail
 * @package App\Mail
 */
class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    private $to_email;

    /**
     * Create a new message instance.
     * @param $to_email
     */
    public function __construct($to_email)
    {
        $this->to_email = $to_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->subject("Awal Private Terminal: Test Email")
            ->to($this->to_email, $this->to_email)
            ->view("emails.test", []);
    }
}
