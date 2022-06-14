<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EliteServiceFeatures extends CustomModel
{
    use HasFactory;

    protected $table = Tables::ELITE_SERVICES_FEATURES;

    protected $fillable = [
        Attributes::FEATURE_DETAILS,
        Attributes::SERVICE_ID,
    ];

}
