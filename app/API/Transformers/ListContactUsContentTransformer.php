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
        Attributes::BACKGROUND_IMAGE_1_URL,
        Attributes::HEADING_TOP_1,
        Attributes::HEADING_1,
        Attributes::HEADING_2,
        Attributes::SUBHEADING_1,
    ];

}
