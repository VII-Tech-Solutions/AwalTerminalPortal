<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class ListImageGalleryContentTransformer
 * @package App\API\Transformers
 */
class ListImageGalleryContentTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::IMAGE_URL,
        Attributes::CAPTION,
        Attributes::SECTION_CONTENT_ID
    ];
}
