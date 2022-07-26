<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class ListEliteServicesContentTransformer
 * @package App\API\Transformers
 */
class ListEliteServicesContentTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::BACKGROUND_IMAGE_1_URL,
        Attributes::BACKGROUND_IMAGE_2_URL,
        Attributes::BACKGROUND_IMAGE_3_URL,
        Attributes::HEADING_TOP_1,
        Attributes::HEADING_TOP_2,
        Attributes::HEADING_1,
        Attributes::HEADING_2,
        Attributes::HEADING_3,
        Attributes::HEADING_4,
        Attributes::HEADING_5,
        Attributes::HEADING_6,
        Attributes::SUBHEADING_1,
        Attributes::PARAGRAPH_1,
        Attributes::PARAGRAPH_2,
        Attributes::PARAGRAPH_3,
        Attributes::PARAGRAPH_4,
        Attributes::TEXT_1,
        Attributes::SQUARE_IMAGE_1_URL,
        Attributes::SQUARE_IMAGE_2_URL,
        Attributes::BIG_IMAGE_1_URL,
        Attributes::BULLET_POINT_1,
        Attributes::BULLET_POINT_2,
        Attributes::BULLET_POINT_3,
        Attributes::BULLET_POINT_4,
        Attributes::BULLET_POINT_5,
        Attributes::BULLET_POINT_6,
        Attributes::BULLET_POINT_7,
    ];
}
