<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use App\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OurStoryContent
 * @package App\Models
 *
 * @property string background_image_1
 * @property string background_image_2
 * @property string background_image_3
 * @property string image_1
 * @property string image_2
 * @property string heading_top_1
 * @property string heading_top_2
 * @property string heading_1
 * @property string heading_2
 * @property string heading_3
 * @property string heading_4
 * @property string heading_5
 * @property string heading_6
 * @property string subheading_1
 * @property string subheading_2
 * @property string paragraph_1
 * @property string paragraph_2
 * @property string paragraph_3
 * @property string paragraph_4
 * @property string quote_1
 * @property string column_1_heading_1
 * @property string column_1_paragraph_1
 * @property string column_2_heading_1
 * @property string column_2_paragraph_1
 */
class OurStoryContent extends CustomModel
{
    use HasFactory;
    protected $table = Tables::OUR_STORY_CONTENT;

    protected $fillable = [
        Attributes::BACKGROUND_IMAGE_1,
        Attributes::BACKGROUND_IMAGE_2,
        Attributes::BACKGROUND_IMAGE_3,
        Attributes::IMAGE_1,
        Attributes::IMAGE_2,
        Attributes::HEADING_TOP_1,
        Attributes::HEADING_TOP_2,
        Attributes::HEADING_1,
        Attributes::HEADING_2,
        Attributes::HEADING_3,
        Attributes::HEADING_4,
        Attributes::HEADING_5,
        Attributes::HEADING_6,
        Attributes::SUBHEADING_1,
        Attributes::SUBHEADING_2,
        Attributes::PARAGRAPH_1,
        Attributes::PARAGRAPH_2,
        Attributes::PARAGRAPH_3,
        Attributes::PARAGRAPH_4,
        Attributes::QUOTE_1,
        Attributes::COLUMN_1_HEADING_1,
        Attributes::COLUMN_1_PARAGRAPH_1,
        Attributes::COLUMN_2_HEADING_1,
        Attributes::COLUMN_2_PARAGRAPH_1,
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
     * Attribute: background image 3
     * @param $value
     * @return string|null
     */
    function getBackgroundImage3Attribute($value) {
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
     * Attribute: image 2
     * @param $value
     * @return string|null
     */
    function getImage2Attribute($value) {
        return Helpers::getCDNLink($value);
    }
}
