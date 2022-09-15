<?php

namespace App\Console\Commands;

use App\Constants\Attributes;
use App\Constants\TransactionStatus;
use App\Helpers;
use App\Mail\PaymentCompleted;
use App\Models\Transaction;
use Illuminate\Console\Command;
use VIITech\Helpers\GlobalHelpers;

class TestReceiptEmail extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {

        /** @var Transaction $transaction */
        $transaction = Transaction::all()->first();

        // send booking receipt to user
        $email = 'fatima.zuhair@viitech.net';
        $data = $transaction->generateReceiptData();
        $email_data = Helpers::sendMailable(new PaymentCompleted($email, 'Tasleem', [$transaction->amount], null, $transaction->id, $transaction, $data), $email);
        $this->info($email_data);
        GlobalHelpers::debugger("Email sent","info");
        GlobalHelpers::debugger($email_data,"info");
        $this->info("Email sent");
    }


}
