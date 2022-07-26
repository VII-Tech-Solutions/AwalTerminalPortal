<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ImageGalleryContent
 * @package App\Models
 *
 * @property string image
 * @property string caption
 * @property integer section_content_id
 */
class ImageGalleryContent extends CustomModel
{
    use HasFactory;
    protected $table = Tables::IMAGE_GALLERY_CONTENT;

    protected $fillable = [
        Attributes::IMAGE,
        Attributes::CAPTION,
        Attributes::SECTION_CONTENT_ID
    ];

    protected $appends = [
        Attributes::IMAGE_URL,
    ];


    function getImageUrlAttribute($value)
    {
        return \Storage::disk("public")->url($this->image);
    }

}
