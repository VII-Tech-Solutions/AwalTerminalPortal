<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class EliteServiceTransformer
 * @package App\API\Transformers
 */
class EliteServiceTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::FLIGHT_TYPE,
        Attributes::FLIGHT_TYPE_NAME,
        Attributes::DATE,
        Attributes::TIME,
        Attributes::FLIGHT_NUMBER,
        Attributes::PASSENGER,
        Attributes::NUMBER_OF_ADULTS,
        Attributes::NUMBER_OF_CHILDREN,
        Attributes::NUMBER_OF_INFANTS,
    ];
}
