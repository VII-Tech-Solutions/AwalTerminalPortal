<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class ListBulletPointsContentTransformer
 * @package App\API\Transformers
 */
class ListBulletPointsContentTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::TEXT,
        Attributes::SECTION_CONTENT_ID
    ];
}
