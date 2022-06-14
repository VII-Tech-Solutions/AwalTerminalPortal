<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Transaction
 */
class Transaction extends CustomModel
{

    protected $table = Tables::TRANSACTIONS;

    protected $fillable = [
        Attributes::ORDER_ID,
        Attributes::ELITE_SERVICE_ID,
        Attributes::AMOUNT,
        Attributes::PAYMENT_PROVIDER,
        Attributes::CREDIMAX_SUCCESS_INDICATOR,
        Attributes::STATUS,
    ];
}

