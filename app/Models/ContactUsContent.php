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
 * @property integer section_type
 * @property string background_image
 * @property string heading_top
 * @property string heading
 * @property string subheading
 */
class ContactUsContent extends CustomModel
{
    use HasFactory;
    protected $table = Tables::CONTACT_US_CONTENT;

    protected $fillable = [
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
    ];

    /**
     * Attribute: background image
     * @param $value
     * @return string|null
     */
    function getBackgroundImageAttribute($value) {
        return Helpers::getCDNLink($value);
    }
}
