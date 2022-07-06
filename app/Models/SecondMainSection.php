<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SecondMainSection
 * @package App\Models
 *
 * @property integer id
 * @property string background_image
 * @property string heading
 * @property string paragraph
 * @property string bullet_points
 */
class SecondMainSection extends CustomModel
{
    use HasFactory;
    protected $table = Tables::SECOND_MAIN_SECTION;

    protected $fillable = [
        Attributes::ID,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING,
        Attributes::PARAGRAPH,
        Attributes::BULLET_POINTS
    ];
}
