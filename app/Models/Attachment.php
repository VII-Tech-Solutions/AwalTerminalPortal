<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Helpers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use http\Url;
use Illuminate\Support\Str;

class Attachment extends CustomModel
{
    use CrudTrait;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'attachments';
    protected $guarded = ['id'];
    protected $fillable = [
        Attributes::NAME,
        Attributes::PATH,
        Attributes::FORM_ID,
        Attributes::SERVICE_ID,
    ];

    protected $appends = [ Attributes::URL ];

    /**
     * Create or Update
     * @param $name
     * @param $type
     * @param $url
     * @param $extension
     * @return static|null
     */
    public static function findOrCreate($name, $type, $url, $extension = null)
    {

        if(!is_null($extension)){
            $name = Str::replaceFirst(".$extension", '', $name);
        }

        /** @var Attachment $attachment */
        $attachment = Attachment::where(Attributes::NAME, $name)->where(Attributes::TYPE, $type)->first();
        if(!is_null($attachment)){
            return $attachment;
        }

        return Attachment::createOrUpdate([
            Attributes::NAME => $name,
            Attributes::PATH => $url,
        ]);

    }

    function getUrlAttribute($value)
    {
        return url($this->path);
    }
}
