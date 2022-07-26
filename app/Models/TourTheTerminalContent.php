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
 * @property string background_image_1
 * @property string background_image_2
 * @property string heading_top_1
 * @property string heading_top_2
 * @property string heading_1
 * @property string heading_2
 * @property string heading_3
 * @property string heading_4
 * @property string heading_5
 * @property string subheading_1
 * @property string paragraph_1
 * @property string paragraph_2
 * @property string paragraph_3
 * @property string image_1
 * @property string visible_1
 * @property string video_1
 */
class TourTheTerminalContent extends CustomModel
{
    use HasFactory;

    protected $table = Tables::TOUR_THE_TERMINAL_CONTENT;

    protected $fillable = [
        Attributes::BACKGROUND_IMAGE_1,
        Attributes::BACKGROUND_IMAGE_2,
        Attributes::HEADING_TOP_1,
        Attributes::HEADING_TOP_2,
        Attributes::HEADING_1,
        Attributes::HEADING_2,
        Attributes::HEADING_3,
        Attributes::HEADING_4,
        Attributes::HEADING_5,
        Attributes::SUBHEADING_1,
        Attributes::PARAGRAPH_1,
        Attributes::PARAGRAPH_2,
        Attributes::PARAGRAPH_3,
        Attributes::IMAGE_1,
    ];

    protected $appends = [
        Attributes::BACKGROUND_IMAGE_1_URL,
        Attributes::BACKGROUND_IMAGE_2_URL,
        Attributes::IMAGE_1_URL,
    ];

    /**
     * Relationship: our photo gallery
     * @return HasMany
     */
    public function OurPhotoGallery()
    {
        return $this->hasMany(OurPhotoGallery::class, Attributes::SECTION_CONTENT_ID, Attributes::ID);
    }

    /**
     * Relationship: private and personal gallery
     * @return HasMany
     */
    public function PrivateAndPersonalGallery()
    {
        return $this->hasMany(PrivateAndPersonalGallery::class, Attributes::SECTION_CONTENT_ID, Attributes::ID);
    }

    /**
     * Attribute: background image 1
     * @param $value
     * @return string|null
     */
    function getBackgroundImage1UrlAttribute($value)
    {
        return \Storage::disk("public")->url( $this->background_image_1);
    }

    /**
     * Attribute: background image 2
     * @param $value
     * @return string|null
     */
    function getBackgroundImage2UrlAttribute($value)
    {
        return \Storage::disk("public")->url( $this->background_image_2);
    }

    /**
     * Attribute: image 1
     * @param $value
     * @return string|null
     */
    function getImage1UrlAttribute($value)
    {
        return \Storage::disk("public")->url( $this->image_1);
    }

}
