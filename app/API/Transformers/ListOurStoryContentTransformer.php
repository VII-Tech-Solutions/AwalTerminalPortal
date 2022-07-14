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
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
        Attributes::PARAGRAPH,
        Attributes::QUOTE,
        Attributes::IMAGE,
        Attributes::COLUMN_1_HEADING,
        Attributes::COLUMN_1_PARAGRAPH,
        Attributes::COLUMN_2_HEADING,
        Attributes::COLUMN_2_PARAGRAPH
    ];

}
