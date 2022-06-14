<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

class FormServicesTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::NAME,
    ];
}
