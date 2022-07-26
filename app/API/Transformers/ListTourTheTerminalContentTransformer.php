<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class ListTourTheTerminalContentTransformer
 * @package App\API\Transformers
 */
class ListTourTheTerminalContentTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::BACKGROUND_IMAGE_1_URL,
        Attributes::BACKGROUND_IMAGE_2_URL,
        Attributes::HEADING_TOP_1,
        Attributes::HEADING_TOP_2,
        Attributes::HEADING_1,
        Attributes::HEADING_2,
        Attributes::HEADING_3,
        Attributes::HEADING_4,
        Attributes::HEADING_5,
        Attributes::SUBHEADING_1,
        Attributes::PARAGRAPH_1,
        Attributes::PARAGRAPH_2,
        Attributes::PARAGRAPH_3,
        Attributes::IMAGE_1_URL,
    ];

    public $defaultIncludes = [
        Attributes::OUR_PHOTO_GALLERY,
        Attributes::PRIVATE_AND_PERSONAL_GALLERY,
    ];

}
