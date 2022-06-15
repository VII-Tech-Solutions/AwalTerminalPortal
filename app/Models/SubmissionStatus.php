<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;

class SubmissionStatus extends CustomModel
{

    protected $table = Tables::SUBMISSION_STATUS;

    protected $fillable = [
        Attributes::NAME,
    ];



}
