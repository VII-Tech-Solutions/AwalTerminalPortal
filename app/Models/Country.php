<?php

namespace App\Models;

use App\Constants\Attributes;
use Illuminate\Database\Eloquent\Model;

class Country extends CustomModel
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    protected $fillable = [
        Attributes::NAME,
    ];
    public function airport()
    {
        return $this->hasMany(Airport::class,Attributes::COUNTRY_ID);
    }
    public function country()
    {
        return $this->hasMany(EliteServices::class,Attributes::NATIONALITY);
    }
}

