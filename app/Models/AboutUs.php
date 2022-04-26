<?php

namespace App\Models;

use App\Constants\Attributes;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends CustomModel
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    protected $fillable = [
        Attributes::TITLE,
        Attributes::DESCRIPTION,
    ];

}
