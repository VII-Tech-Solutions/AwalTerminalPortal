<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class ListContactUsContentTransformer
 * @package App\API\Transformers
 */
class ListContactUsContentTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
    ];

}
