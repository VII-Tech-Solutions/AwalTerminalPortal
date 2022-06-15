<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Support\Str;

/**
 * Attachment
 */
class Attachment extends CustomModel
{

    protected $table = Tables::ATTACHMENTS;

    protected $fillable = [
        Attributes::NAME,
        Attributes::PATH,
        Attributes::FORM_ID,
        Attributes::SERVICE_ID,
    ];

    protected $appends = [
        Attributes::URL
    ];

    public function form()
    {
        return $this->belongsTo(GeneralAviationServices::class,Attributes::FORM_ID);
    }

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

    /**
     * Get Attribute: url
     * @param $value
     * @return string
     */
    function getUrlAttribute($value)
    {
        return \Storage::disk("public")->url($this->path);
        return url($this->path);
    }
}
