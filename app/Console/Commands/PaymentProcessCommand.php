<?php

namespace App\Console\Commands;

use App\Constants\Attributes;
use App\Constants\ESStatus;
use App\Models\Bookers;
use App\Models\EliteServices;
use Illuminate\Console\Command;

/**
 * Payment Process
 */
class PaymentProcessCommand extends Command
{
    protected $signature = 'process:payment {email?}';

    protected $description = 'Payment Process Command';

    public $email;

    /**
     * Handle
     */
    public function handle()
    {

        $this->email = $this->argument("email");

        // get elite service
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::where(Attributes::SUBMISSION_STATUS_ID, ESStatus::PENDING_APPROVAL)->orderByDesc(Attributes::CREATED_AT)->first();

        // validate elite service
        if(is_null($elite_service)){
            dd("Elite service is null");
        }

        // change status
        $this->changeStatus($elite_service);

    }

    /**
     * Change Status
     * @param EliteServices $elite_service
     */
    function changeStatus($elite_service){


        // get booker
        /** @var Bookers $booker */
        $booker = $elite_service->booker()->first();

        if(empty($this->email)){
            $this->email = $booker->email;
        }

        // pending approval
        EliteServices::changeStatus($elite_service->id, $booker->first_name, $this->email, ESStatus::PENDING_APPROVAL, null);

        // rejection
        EliteServices::changeStatus($elite_service->id, $booker->first_name, $this->email, ESStatus::REJECTED, "Just Because");

        // approved
        EliteServices::changeStatus($elite_service->id, $booker->first_name, $this->email, ESStatus::APPROVED, null);

    }
}
