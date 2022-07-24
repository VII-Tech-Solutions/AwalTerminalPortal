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
 * @property string background_image_1
 * @property string background_image_2
 * @property string heading_top_1
 * @property string heading_top_2
 * @property string heading_1
 * @property string heading_2
 * @property string heading_3
 * @property string heading_4
 * @property string heading_5
 * @property string heading_6
 * @property string subheading_1
 * @property string paragraph_1
 * @property string paragraph_2
 * @property string paragraph_3
 * @property string paragraph_4
 * @property string square_image_1
 * @property string square_image_2
 * @property string big_image_1
 * @property string image_1
 * @property string section_image_1
 * @property string text_1
 * @property string bullet_point_1
 * @property string bullet_point_2
 * @property string bullet_point_3
 * @property string bullet_point_4
 * @property string bullet_point_5
 * @property string bullet_point_6

 */
class GeneralAviationContent extends CustomModel
{
    use HasFactory;
    protected $table = Tables::GENERAL_AVIATION_CONTENT;

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
        Attributes::HEADING_6,
        Attributes::SUBHEADING_1,
        Attributes::PARAGRAPH_1,
        Attributes::PARAGRAPH_2,
        Attributes::PARAGRAPH_3,
        Attributes::PARAGRAPH_4,
        Attributes::SQUARE_IMAGE_1,
        Attributes::SQUARE_IMAGE_2,
        Attributes::BIG_IMAGE_1,
        Attributes::IMAGE_1,
        Attributes::SECTION_IMAGE_1,
        Attributes::TEXT_1,
        Attributes::BULLET_POINT_1,
        Attributes::BULLET_POINT_2,
        Attributes::BULLET_POINT_3,
        Attributes::BULLET_POINT_4,
        Attributes::BULLET_POINT_5,
        Attributes::BULLET_POINT_6,
    ];

    /**
     * Attribute: background image 1
     * @param $value
     * @return string|null
     */
    function getBackgroundImage1Attribute($value) {
        return Helpers::getCDNLink($value);
    }

    /**
     * Attribute: background image 2
     * @param $value
     * @return string|null
     */
    function getBackgroundImage2Attribute($value) {
        return Helpers::getCDNLink($value);
    }

    /**
     * Attribute: square image 1
     * @param $value
     * @return string|null
     */
    function getSquareImage1Attribute($value) {
        return Helpers::getCDNLink($value);
    }

    /**
     * Attribute: square image 2
     * @param $value
     * @return string|null
     */
    function getSquareImage2Attribute($value) {
        return Helpers::getCDNLink($value);
    }

    /**
     * Attribute: big image 1
     * @param $value
     * @return string|null
     */
    function getBigImage1Attribute($value) {
        return Helpers::getCDNLink($value);
    }

    /**
     * Attribute: image 1
     * @param $value
     * @return string|null
     */
    function getImage1Attribute($value) {
        return Helpers::getCDNLink($value);
    }

    /**
     * Attribute: section image 1
     * @param $value
     * @return string|null
     */
    function getSectionImage1Attribute($value) {
        return Helpers::getCDNLink($value);
    }
}
