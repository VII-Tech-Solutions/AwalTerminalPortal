<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

class EliteServiceFeaturesTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::FEATURE_DETAILS,
        Attributes::SERVICE_ID,
    ];
}
