<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Country
 */
class Country extends CustomModel
{
    use CrudTrait;

    protected $table = Tables::COUNTRIES;

    protected $fillable = [
        Attributes::NAME,
    ];

    /**
     * Relationship: airport
     * @return HasMany
     */
    public function airport()
    {
        return $this->hasMany(Airport::class,Attributes::COUNTRY_ID);
    }

    /**
     * Relationship: country
     * @return HasMany
     */
    public function country()
    {
        return $this->hasMany(EliteServices::class,Attributes::NATIONALITY);
    }
}

