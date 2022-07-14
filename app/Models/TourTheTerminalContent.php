<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use App\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class TourTheTerminalContent
 * @package App\Models
 *
 * @property string section_type
 * @property string background_image
 * @property string heading_top
 * @property string heading
 * @property string subheading
 * @property string paragraph
 * @property string image
 * @property string section_image
 * @property boolean has_bullet_points
 * @property string visible
 * @property string video
 */
class TourTheTerminalContent extends CustomModel
{
    use HasFactory;
    protected $table = Tables::TOUR_THE_TERMINAL_CONTENT;

    protected $fillable = [
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
        Attributes::PARAGRAPH,
        Attributes::IMAGE,
        Attributes::SECTION_IMAGE,
        Attributes::HAS_BULLET_POINTS,
        Attributes::VISIBLE,
        Attributes::VIDEO
    ];

    /**
     * Relationship: image gallery content
     * @return HasMany
     */
    public function imageGalleryContent() {
        return $this->hasMany(ImageGalleryContent::class, Attributes::SECTION_CONTENT_ID, Attributes::ID);
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
     * Attribute: section image
     * @param $value
     * @return string|null
     */
    function getSectionImageAttribute($value) {
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
     * Attribute: video
     * @param $value
     * @return string|null
     */
    function getVideoAttribute($value) {
        return Helpers::getCDNLink($value);
    }
}
