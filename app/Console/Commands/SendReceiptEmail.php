<?php

namespace App\Console\Commands;

use App\Constants\Attributes;
use App\Helpers;
use App\Mail\PaymentCompleted;
use App\Models\Bookers;
use App\Models\EliteServices;
use App\Models\Transaction;
use Illuminate\Console\Command;
use VIITech\Helpers\GlobalHelpers;

class SendReceiptEmail extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:receipt_email {transaction_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send receipt Email';

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

        $transaction_id = $this->argument('transaction_id');

        /** @var Transaction $transaction */
        $transaction = Transaction::query()->find($transaction_id);

        $elite_service = EliteServices::query()->where(Attributes::ID, $transaction->elite_service_id)->first();

        $user = Bookers::query()->where(Attributes::SERVICE_ID, $elite_service->id)->first();

        // send booking receipt to user
        $email = $user->email;
        $name = $user->first_name . ' ' . $user->last_name;
        $data = $transaction->generateReceiptData();
        $email_data = Helpers::sendMailable(new PaymentCompleted($email, $name, [$transaction->amount], null, $transaction->id, $data), $email);
        $this->info($email_data);
        GlobalHelpers::debugger("Email sent", "info");
        GlobalHelpers::debugger($email_data, "info");
        $this->info("Email sent");
    }


}
