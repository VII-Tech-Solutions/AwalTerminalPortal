<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

class EliteServiceTypesTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::NAME,
        Attributes::PRICE_PER_ADULT,
    ];
}
