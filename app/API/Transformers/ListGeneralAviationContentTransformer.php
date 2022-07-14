<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class ListGeneralAviationContentTransformer
 * @package App\API\Transformers
 */
class ListGeneralAviationContentTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
        Attributes::PARAGRAPH,
        Attributes::SQUARE_IMAGE,
        Attributes::BIG_IMAGE,
        Attributes::IMAGE,
        Attributes::SECTION_IMAGE,
        Attributes::TEXT,
        Attributes::HAS_BULLET_POINTS
    ];

    public $defaultIncludes = [
        Attributes::BULLET_POINTS
    ];

}
