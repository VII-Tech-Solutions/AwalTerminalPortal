<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use App\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Attribute: background image 1
     * @param $value
     * @return string|null
     */
    function getBackgroundImage1Attribute($value) {
        return Helpers::getCDNLink($value);
    }
}
