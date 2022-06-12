<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;

/**
 * Contact Us
 */
class ContactUs extends CustomModel
{

    protected $table = Tables::CONTACT_US;

    protected $fillable = [
        Attributes::FIRST_NAME,
        Attributes::LAST_NAME,
        Attributes::EMAIL,
        Attributes::MESSAGE
    ];
}
