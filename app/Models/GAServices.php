<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GAServices  extends CustomModel
{
    protected $table = Tables::GA_SERVICES;

    protected $fillable = [
        Attributes::GENERAL_AVIATION_ID,
        Attributes::SERVICE_ID,
        Attributes::HOTEL_NAME,
        Attributes::TIME
    ];

}
