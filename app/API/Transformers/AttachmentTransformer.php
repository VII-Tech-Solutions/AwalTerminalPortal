<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

class AttachmentTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::URL,
    ];
}
