<?php

namespace App\Traits;

use App\Constants\Attributes;
use App\Constants\GroupType;
use App\Constants\Status;
use App\Helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait ModelTrait
{

    /**
     * Set Password
     * @param $value
     */
    public function setPassword($value){
        if(!empty($value) && Hash::needsRehash($value)){
            $this->attributes[Attributes::PASSWORD] = Hash::make($value);
        }else if(!empty($value)){
            $this->attributes[Attributes::PASSWORD] = $value;
        }
    }

    /**
     * Get Attribute: status_name
     * @param $value
     * @return string
     */
    public function getStatusName($value)
    {
        $text = Status::getKey($this->status);
        return Helpers::readableText($text);
    }

    /**
     * Get Attribute: group_types_name
     * @param $value
     * @return string
     */
    public function getGroupTypesName($value)
    {
        $text = GroupType::getKey($this->types);
        return Helpers::readableText($text);
    }

    /**
     * Set Attribute: Image
     * @param $value
     * @param $directory_path
     */
    public function setImage($value, $directory_path = "/uploads")
    {
        $image = trim($value);
        if(Str::startsWith($image, "http")){
            $this->attributes[Attributes::IMAGE] = $image;
            return;
        }
        if(!empty($image)){
            $path = Helpers::uploadFile($this, $image, Attributes::IMAGE, $directory_path, true, false, true);
            $this->attributes[Attributes::IMAGE] = str_replace($directory_path, "", $path);
        }else{
            $this->attributes[Attributes::IMAGE] = null;
        }
    }
}
