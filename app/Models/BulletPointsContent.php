<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BulletPointsContent
 * @package App\Models
 *
 * @property string text
 * @property integer section_content_id
 */
class BulletPointsContent extends CustomModel
{
    use HasFactory;
    protected $table = Tables::BULLET_POINTS_CONTENT;

    protected $fillable = [
        Attributes::TEXT,
        Attributes::SECTION_CONTENT_ID
    ];
}
