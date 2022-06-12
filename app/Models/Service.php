<?php

namespace App\Models;

use App\Constants\Attributes;
use Illuminate\Database\Eloquent\Model;

class Service extends CustomModel
{

    protected $fillable = [
        Attributes::TITLE,
        Attributes::DESCRIPTION,
        Attributes::SERVICE_TYPE,
        Attributes::PRICE,
        Attributes::STATUS,
    ];
}
