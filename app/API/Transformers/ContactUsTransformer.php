<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class ContactUsTransformer
 * @package App\API\Transformers
 */
class ContactUsTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::FIRST_NAME,
        Attributes::LAST_NAME,
        Attributes::EMAIL,
        Attributes::MESSAGE,
        Attributes::CREATED_AT,
    ];
}
