<?php

namespace App\Models;

use App\Constants\Attributes;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends CustomModel
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    protected $fillable = [
        Attributes::FIRST_NAME,
        Attributes::LAST_NAME,
        Attributes::EMAIL,
        Attributes::MESSAGE
    ];
}
