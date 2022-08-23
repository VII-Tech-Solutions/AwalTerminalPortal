<?php

namespace App\Console\Commands;

use App\Constants\Attributes;
use App\Helpers;
use App\Mail\ContactUsMail;
use Illuminate\Console\Command;
use VIITech\Helpers\GlobalHelpers;

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
        $result = Helpers::sendMailable(new ContactUsMail(  [
            Attributes::LINK => url("")
        ]), $email);
        $this->info("Email sent: " . GlobalHelpers::readableBoolean($result));
    }
}
