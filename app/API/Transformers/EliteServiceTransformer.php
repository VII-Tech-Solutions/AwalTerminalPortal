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
        Attributes::SERVICE_ID,
        Attributes::IS_ARRIVAL_FLIGHT,
        Attributes::AIRPORT_ID,
        Attributes::DATE,
        Attributes::TIME,
        Attributes::FLIGHT_NUMBER,
        Attributes::PASSENGER,
        Attributes::NUMBER_OF_ADULTS,
        Attributes::NUMBER_OF_CHILDREN,
        Attributes::NUMBER_OF_INFANTS,
    ];
}
