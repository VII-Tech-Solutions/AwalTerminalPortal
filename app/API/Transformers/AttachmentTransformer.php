<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class AttachmentTransformer
 * @package App\API\Transformers
 */
class AttachmentTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::URL,
        Attributes::FILE_LABEL
    ];
}
