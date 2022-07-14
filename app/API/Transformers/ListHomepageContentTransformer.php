<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class ListHomepageContentTransformer
 * @package App\API\Transformers
 */
class ListHomepageContentTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
        Attributes::PARAGRAPH,
        Attributes::SQUARE_IMAGE,
        Attributes::IMAGE,
        Attributes::SECTION_IMAGE,
        Attributes::HAS_BULLET_POINTS,
    ];

    public $defaultIncludes = [
        Attributes::BULLET_POINTS,
    ];

}
