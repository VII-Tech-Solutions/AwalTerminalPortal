<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

/**
 * About Us
 */
class AboutUs extends CustomModel
{
    use CrudTrait;

    protected $table = Tables::ABOUT_US;

    protected $fillable = [
        Attributes::TITLE,
        Attributes::DESCRIPTION,
    ];

}
