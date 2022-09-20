<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class AirportTransformer
 * @package App\API\Transformers
 */
class AirportTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::NAME,
        Attributes::FULL_NAME,
        Attributes::COUNTRY_ID,
    ];

}
