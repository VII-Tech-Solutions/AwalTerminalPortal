<?php

namespace App\Constants;

use BenSampo\Enum\Enum;

class PaymentGateways extends Enum
{
    const AFS = "afs";
    const CREDIMAX = "credimax";
    const BENEFIT = "benefit";
}
