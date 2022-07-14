<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use App\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class GeneralAviationContent
 * @package App\Models
 *
 * @property string section_type
 * @property string background_image
 * @property string heading_top
 * @property string heading
 * @property string subheading
 * @property string paragraph
 * @property string square_image
 * @property string big_image
 * @property string image
 * @property string section_image
 * @property string text
 * @property boolean has_bullet_points
 */
class GeneralAviationContent extends CustomModel
{
    use HasFactory;
    protected $table = Tables::GENERAL_AVIATION_CONTENT;

    protected $fillable = [
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
        Attributes::PARAGRAPH,
        Attributes::SQUARE_IMAGE,
        Attributes::BIG_IMAGE,
        Attributes::IMAGE,
        Attributes::SECTION_IMAGE,
        Attributes::TEXT,
        Attributes::HAS_BULLET_POINTS
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
     * Attribute: square image
     * @param $value
     * @return string|null
     */
    function getSquareImageAttribute($value) {
        return Helpers::getCDNLink($value);
    }

    /**
     * Attribute: big image
     * @param $value
     * @return string|null
     */
    function getBigImageAttribute($value) {
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

    /**
     * Attribute: section image
     * @param $value
     * @return string|null
     */
    function getSectionImageAttribute($value) {
        return Helpers::getCDNLink($value);
    }
}
