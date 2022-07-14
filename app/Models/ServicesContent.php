<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use App\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ServicesContent
 * @package App\Models
 *
 * @property string section_type
 * @property string background_image
 * @property string image
 * @property string heading_top
 * @property string heading
 * @property string subheading
 * @property string paragraph
 * @property string quote
 * @property string column_1_heading
 * @property string column_1_paragraph
 * @property string column_2_heading
 * @property string column_2_paragraph
 * @property boolean has_bullet_points

 */
class ServicesContent extends CustomModel
{
    use HasFactory;
    protected $table = Tables::SERVICES_CONTENT;

    protected $fillable = [
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
        Attributes::PARAGRAPH,
        Attributes::QUOTE,
        Attributes::COLUMN_1_HEADING,
        Attributes::COLUMN_1_PARAGRAPH,
        Attributes::COLUMN_2_HEADING,
        Attributes::COLUMN_2_PARAGRAPH,
        Attributes::HAS_BULLET_POINTS,
    ];
    /**
     * Relationship: bullet points content
     * @return HasMany
     */
    public function bulletPointsContent() {
        return $this->hasMany(BulletPointsContent::class, Attributes::SECTION_CONTENT_ID, Attributes::ID);
    }

    /**
     * Attribute: background image
     * @param $value
     * @return string|null
     */
    function getBackgroundImageAttribute($value) {
        return Helpers::getCDNLink($value);
    }

    /**
     * Attribute: image
     * @param $value
     * @return string|null
     */
    function getImageAttribute($value) {
        return Helpers::getCDNLink($value);
    }
}
