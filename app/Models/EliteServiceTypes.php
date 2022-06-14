<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;

class EliteServiceTypes extends CustomModel
{

    protected $table = Tables::ELITE_SERVICES_TYPES;

    protected $fillable = [
        Attributes::PRICE_PER_ADULT,
        Attributes::NAME,
    ];


}
