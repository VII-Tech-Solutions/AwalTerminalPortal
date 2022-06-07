<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

class CountryTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::NAME,
    ];
}
