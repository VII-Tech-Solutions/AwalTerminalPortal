<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailCommand extends Command
{
    protected $signature = 'send:email {email?}';

    protected $description = 'Send Email Command';

    public function handle()
    {
        $email = $this->argument("email");
        if(empty($email)){
            dd("Invalid Email");
        }
        $this->sendMailable(new TestMail($email), $email);
        $this->info("Email sent");
    }

    /**
     * Send Mailable
     * @param $mailable
     * @param $send_to_emails
     * @return mixed
     */
    function sendMailable($mailable, $send_to_emails)
    {
        try {
            if (env("ENABLE_SENDING_EMAILS", true)) {
                Mail::to($send_to_emails)->send($mailable);
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
