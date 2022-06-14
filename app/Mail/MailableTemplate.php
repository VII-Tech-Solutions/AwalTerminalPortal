<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * class MailableTemplate
 * @package App\Mail
 */
class MailableTemplate extends Mailable
{
    use Queueable, SerializesModels;

    public $to_email, $to_name, $title, $view, $data;

    /**
     * Create a new message instance.
     * @param $to_email
     * @param $to_name
     * @param $title
     * @param $view
     * @param $data
     */
    public function __construct($to_email, $to_name, $data, $title, $view)
    {
        $this->to_email = $to_email;
        $this->to_name = $to_name;
        $this->title = $title;
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Build the message
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)
            ->to($this->to_email, $this->to_name)
            ->view($this->view, $this->data);
    }
}
