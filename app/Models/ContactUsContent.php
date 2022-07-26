<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ContactUsContent
 * @package App\Models
 *
 * @property string background_image_1
 * @property string heading_top_1
 * @property string heading_1
 * @property string heading_2
 * @property string subheading_1
 */
class ContactUsContent extends CustomModel
{
    use HasFactory;

    protected $table = Tables::CONTACT_US_CONTENT;

    protected $fillable = [
        Attributes::BACKGROUND_IMAGE_1,
        Attributes::HEADING_TOP_1,
        Attributes::HEADING_1,
        Attributes::HEADING_2,
        Attributes::SUBHEADING_1,
    ];

    protected $appends = [
        Attributes::BACKGROUND_IMAGE_1_URL,
    ];

    /**
     * Attribute: background image 1
     * @param $value
     * @return string|null
     */
    function getBackgroundImage1UrlAttribute($value)
    {
        return \Storage::disk("public")->url($this->background_image_1);
    }
}
