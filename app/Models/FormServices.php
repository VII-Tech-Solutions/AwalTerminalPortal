<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormServices extends CustomModel
{

    protected $table = Tables::FORM_SERVICES;

    protected $fillable = [
        Attributes::NAME,
    ];

}
