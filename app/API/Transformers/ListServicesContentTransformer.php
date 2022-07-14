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
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
        Attributes::PARAGRAPH,
        Attributes::QUOTE,
        Attributes::COLUMN_1_HEADING,
        Attributes::COLUMN_1_PARAGRAPH,
        Attributes::COLUMN_2_HEADING,
        Attributes::COLUMN_2_PARAGRAPH,
        Attributes::HAS_BULLET_POINTS
    ];

    public $defaultIncludes = [
        Attributes::BULLET_POINTS
    ];

}
