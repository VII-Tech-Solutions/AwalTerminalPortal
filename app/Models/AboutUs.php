<?php

namespace App\Models;

use App\Constants\Attributes;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

/**
 * About Us
 */
class AboutUs extends CustomModel
{
    use CrudTrait;

    protected $fillable = [
        Attributes::TITLE,
        Attributes::DESCRIPTION,
    ];

}
