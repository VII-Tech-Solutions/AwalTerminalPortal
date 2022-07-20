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
        Attributes::BACKGROUND_IMAGE_1,
        Attributes::BACKGROUND_IMAGE_2,
        Attributes::BACKGROUND_IMAGE_3,
        Attributes::BACKGROUND_IMAGE_4,
        Attributes::HEADING_TOP_1,
        Attributes::HEADING_TOP_2,
        Attributes::HEADING_1,
        Attributes::HEADING_2,
        Attributes::HEADING_3,
        Attributes::HEADING_4,
        Attributes::SUBHEADING_1,
        Attributes::PARAGRAPH_1,
        Attributes::PARAGRAPH_2,
        Attributes::PARAGRAPH_3,
        Attributes::PARAGRAPH_4,
        Attributes::SQUARE_IMAGE_1,
        Attributes::IMAGE_1,
        Attributes::IMAGE_2,
        Attributes::SECTION_IMAGE_1,
        Attributes::BULLET_POINT_1,
        Attributes::BULLET_POINT_2,
        Attributes::BULLET_POINT_3,
        Attributes::BULLET_POINT_4,
        Attributes::BULLET_POINT_5,
    ];
}
