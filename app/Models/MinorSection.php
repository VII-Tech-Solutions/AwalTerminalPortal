<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class MinorSection
 * @package App\Models
 *
 * @property string image
 * @property string paragraph
 */
class MinorSection extends CustomModel
{
    use HasFactory;
    protected $table = Tables::MINOR_SECTION;

    protected $fillable = [
        Attributes::ID,
        Attributes::IMAGE,
        Attributes::PARAGRAPH,
    ];
}
