<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

/**
 * Passengers
 */
class Passengers extends CustomModel
{
    use CrudTrait;

    protected $table = Tables::PASSENGERS;

    protected $fillable = [
        Attributes::FIRST_NAME,
        Attributes::LAST_NAME,
        Attributes::GENDER,
        Attributes::BIRTH_DATE,
        Attributes::NATIONALITY_ID,
        Attributes::FLIGHT_CLASS,
        Attributes::SERVICE_ID,
    ];
}
