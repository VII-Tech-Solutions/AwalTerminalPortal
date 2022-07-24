<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class ListOurStoryContentTransformer
 * @package App\API\Transformers
 */
class ListOurStoryContentTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::BACKGROUND_IMAGE_1,
        Attributes::BACKGROUND_IMAGE_2,
        Attributes::BACKGROUND_IMAGE_3,
        Attributes::IMAGE_1,
        Attributes::IMAGE_2,
        Attributes::HEADING_TOP_1,
        Attributes::HEADING_TOP_2,
        Attributes::HEADING_1,
        Attributes::HEADING_2,
        Attributes::HEADING_3,
        Attributes::HEADING_4,
        Attributes::HEADING_5,
        Attributes::HEADING_6,
        Attributes::SUBHEADING_1,
        Attributes::SUBHEADING_2,
        Attributes::PARAGRAPH_1,
        Attributes::PARAGRAPH_2,
        Attributes::PARAGRAPH_3,
        Attributes::PARAGRAPH_4,
        Attributes::QUOTE_1,
        Attributes::COLUMN_1_HEADING_1,
        Attributes::COLUMN_1_PARAGRAPH_1,
        Attributes::COLUMN_2_HEADING_1,
        Attributes::COLUMN_2_PARAGRAPH_1,
    ];
}
