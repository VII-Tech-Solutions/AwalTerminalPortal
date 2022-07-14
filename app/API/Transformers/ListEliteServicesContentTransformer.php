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
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
        Attributes::PARAGRAPH,
        Attributes::TEXT,
        Attributes::SQUARE_IMAGE,
        Attributes::BIG_IMAGE,
        Attributes::HAS_BULLET_POINTS
    ];

    public $defaultIncludes = [
        Attributes::BULLET_POINTS
    ];

}
