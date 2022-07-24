<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class ListServicesContentTransformer
 * @package App\API\Transformers
 */
class ListServicesContentTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::BACKGROUND_IMAGE_1,
        Attributes::BACKGROUND_IMAGE_2,
        Attributes::BACKGROUND_IMAGE_3,
        Attributes::HEADING_TOP_1,
        Attributes::HEADING_TOP_2,
        Attributes::HEADING_1,
        Attributes::HEADING_2,
        Attributes::HEADING_3,
        Attributes::HEADING_4,
        Attributes::SUBHEADING_1,
        Attributes::PARAGRAPH_1,
        Attributes::COLUMN_1_HEADING_1,
        Attributes::COLUMN_1_PARAGRAPH_1,
        Attributes::COLUMN_2_HEADING_1,
        Attributes::COLUMN_2_PARAGRAPH_1,
        Attributes::BULLET_POINT_1,
        Attributes::BULLET_POINT_2,
        Attributes::BULLET_POINT_3,
        Attributes::BULLET_POINT_4,
        Attributes::BULLET_POINT_5,
        Attributes::BULLET_POINT_6,
        Attributes::BULLET_POINT_7,
        Attributes::BULLET_POINT_8,
    ];
}
