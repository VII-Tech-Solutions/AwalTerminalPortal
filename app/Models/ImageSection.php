<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;

/**
 * Class ImageSection
 * @package App\Models
 *
 * @property integer id
 * @property string section_image
 */
class ImageSection extends CustomModel
{
    protected $table = Tables::IMAGE_SECTION;

    protected $fillable = [
        Attributes::ID,
        Attributes::SECTION_IMAGE
    ];
}
