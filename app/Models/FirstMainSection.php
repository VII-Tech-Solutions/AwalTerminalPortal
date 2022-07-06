<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FirstMainSection
 * @package App\Models
 *
 * @property integer id
 * @property string background_image
 * @property string square_image
 * @property string heading
 * @property string paragraph
 */
class FirstMainSection extends CustomModel
{
    use HasFactory;
    protected $table = Tables::FIRST_MAIN_SECTION;

    protected $fillable = [
        Attributes::ID,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING,
        Attributes::PARAGRAPH,
        Attributes::SQUARE_IMAGE,

    ];
}
