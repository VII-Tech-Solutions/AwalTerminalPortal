<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OurPhotoGallery
 * @package App\Models
 *
 * @property string image
 * @property string caption
 * @property integer section_content_id
 */
class OurPhotoGallery extends Model
{
    use HasFactory;
    protected $table = Tables::OUR_PHOTO_GALLERY;

    protected $fillable = [
        Attributes::IMAGE,
        Attributes::CAPTION,
        Attributes::SECTION_CONTENT_ID
    ];
}
