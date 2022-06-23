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
    protected $signature = 'process:payment';

    protected $description = 'Payment Process Command';

    /**
     * Handle
     */
    public function handle()
    {

        // get elite service
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::where(Attributes::STATUS, ESStatus::PENDING_APPROVAL)->orderByDesc(Attributes::CREATED_AT)->first();

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
        $booker = $elite_service->bookers()->first();

        // pending approval
        EliteServices::changeStatus($elite_service->id, $booker->first_name, $booker->email, ESStatus::PENDING_APPROVAL, null);

        // rejection
        EliteServices::changeStatus($elite_service->id, $booker->first_name, $booker->email, ESStatus::REJECTED, "Just Because");

        // approved
        EliteServices::changeStatus($elite_service->id, $booker->first_name, $booker->email, ESStatus::APPROVED, null);

    }
}
