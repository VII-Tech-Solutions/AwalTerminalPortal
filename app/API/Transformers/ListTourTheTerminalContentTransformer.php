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
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
        Attributes::IMAGE,
        Attributes::PARAGRAPH,
        Attributes::HAS_IMAGE_GALLERY,
        Attributes::VISIBLE,
        Attributes::VIDEO
    ];

    public $defaultIncludes = [
        Attributes::IMAGE_GALLERY
    ];

}
