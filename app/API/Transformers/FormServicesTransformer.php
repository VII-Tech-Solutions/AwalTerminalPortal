<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class FormServicesTransformer
 * @package App\API\Transformers
 */
class FormServicesTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::NAME,
    ];
}
