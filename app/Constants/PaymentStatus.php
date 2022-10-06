<?php

namespace App\Constants;

use BenSampo\Enum\Enum;

class PaymentStatus extends Enum
{
    const FAILED = 0;
    const SUCCESS = 1;
    const PENDING = 2;
}
