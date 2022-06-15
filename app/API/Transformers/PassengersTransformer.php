<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class PassengersTransformer
 * @package App\API\Transformers
 */
class PassengersTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::FIRST_NAME,
        Attributes::LAST_NAME,
        Attributes::GENDER,
        Attributes::BIRTH_DATE,
        Attributes::NATIONALITY_ID,
        Attributes::FLIGHT_CLASS,
        Attributes::SERVICE_ID,
    ];




}
