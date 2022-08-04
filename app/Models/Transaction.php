<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Transaction
 *
 * @property string amount
 * @property string order_id
 * @property string uuid
 * @property integer payment_provider
 */
class Transaction extends CustomModel
{

    protected $table = Tables::TRANSACTIONS;

    protected $fillable = [
        Attributes::ID,
        Attributes::ORDER_ID,
        Attributes::ELITE_SERVICE_ID,
        Attributes::AMOUNT,
        Attributes::UUID,
        Attributes::PAYMENT_PROVIDER,
        Attributes::CREDIMAX_SUCCESS_INDICATOR,
        Attributes::STATUS,
    ];
}

