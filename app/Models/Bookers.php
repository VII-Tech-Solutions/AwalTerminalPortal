<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;

/**
 * Bookers
 */
class Bookers extends CustomModel
{

    protected $table = Tables::BOOKERS;

    protected $fillable = [
        Attributes::FIRST_NAME,
        Attributes::LAST_NAME,
        Attributes::MOBILE_NUMBER,
        Attributes::COMMENTS,
        Attributes::SERVICE_ID,
    ];
}
