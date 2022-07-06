<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class HeaderSection
 * @package App\Models
 *
 * @property integer id
 * @property string background_image
 * @property string heading_top
 * @property string heading
 * @property string subheading
 */
class HeaderSection extends CustomModel
{
    use HasFactory;
    protected $table = Tables::HEADER_SECTION;

    protected $fillable = [
        Attributes::ID,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING
    ];
}
