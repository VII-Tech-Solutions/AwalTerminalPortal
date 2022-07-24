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
 * @property string background_image_1
 * @property string background_image_2
 * @property string background_image_3
 * @property string heading_top_1
 * @property string heading_top_2
 * @property string heading_1
 * @property string heading_2
 * @property string heading_3
 * @property string heading_4
 * @property string subheading_1
 * @property string paragraph_1
 * @property string column_1_heading_1
 * @property string column_1_paragraph_1
 * @property string column_2_heading_1
 * @property string column_2_paragraph_1
 * @property string bullet_point_1
 * @property string bullet_point_2
 * @property string bullet_point_3
 * @property string bullet_point_4
 * @property string bullet_point_5
 * @property string bullet_point_6
 * @property string bullet_point_7
 * @property string bullet_point_8
 */
class ServicesContent extends CustomModel
{
    use HasFactory;
    protected $table = Tables::SERVICES_CONTENT;

    protected $fillable = [
        Attributes::BACKGROUND_IMAGE_1,
        Attributes::BACKGROUND_IMAGE_2,
        Attributes::BACKGROUND_IMAGE_3,
        Attributes::HEADING_TOP_1,
        Attributes::HEADING_TOP_2,
        Attributes::HEADING_1,
        Attributes::HEADING_2,
        Attributes::HEADING_3,
        Attributes::HEADING_4,
        Attributes::SUBHEADING_1,
        Attributes::PARAGRAPH_1,
        Attributes::COLUMN_1_HEADING_1,
        Attributes::COLUMN_1_PARAGRAPH_1,
        Attributes::COLUMN_2_HEADING_1,
        Attributes::COLUMN_2_PARAGRAPH_1,
        Attributes::BULLET_POINT_1,
        Attributes::BULLET_POINT_2,
        Attributes::BULLET_POINT_3,
        Attributes::BULLET_POINT_4,
        Attributes::BULLET_POINT_5,
        Attributes::BULLET_POINT_6,
        Attributes::BULLET_POINT_7,
        Attributes::BULLET_POINT_8,
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
}
