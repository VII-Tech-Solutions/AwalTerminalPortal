<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class CountryTransformer
 * @package App\API\Transformers
 */
class CountryTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::NAME,
    ];
}
