<?php

namespace App\API\Transformers;

use App\Constants\Attributes;

/**
 * Class EliteServiceFeaturesTransformer
 * @package App\API\Transformers
 */
class EliteServiceFeaturesTransformer extends CustomTransformer
{
    public $fields = [
        Attributes::ID,
        Attributes::FEATURE_DETAILS,
        Attributes::SERVICE_ID,
    ];
}
