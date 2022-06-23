<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;

/**
 * Passengers
 */
class Passengers extends CustomModel
{

    protected $table = Tables::PASSENGERS;

    protected $fillable = [
        Attributes::TITLE,
        Attributes::FIRST_NAME,
        Attributes::LAST_NAME,
        Attributes::GENDER,
        Attributes::BIRTH_DATE,
        Attributes::NATIONALITY_ID,
        Attributes::FLIGHT_CLASS,
        Attributes::SERVICE_ID,
    ];

    public function country()
    {
        return $this->belongsTo(Country::class,Attributes::NATIONALITY_ID);
    }

    public function service()
    {
        return $this->belongsTo(EliteServices::class,Attributes::SERVICE_ID);
    }

}
