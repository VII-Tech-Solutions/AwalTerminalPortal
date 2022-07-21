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
        Attributes::BACKGROUND_IMAGE_1,
        Attributes::BACKGROUND_IMAGE_2,
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
        Attributes::IMAGE_1,
        Attributes::VISIBLE_1,
        Attributes::VIDEO_1
    ];

    public $defaultIncludes = [
        Attributes::OUR_PHOTO_GALLERY,
        Attributes::PRIVATE_AND_PERSONAL_GALLERY,
    ];

}
