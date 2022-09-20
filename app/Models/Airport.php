<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Airport
 * @property string name
 * @property string iata
 * @property string city
 * @property Country country
 *
 */
class Airport extends CustomModel
{

    protected $table = Tables::AIRPORTS;

    protected $fillable = [
        Attributes::NAME,
        Attributes::IATA,
        Attributes::ICAO,
        Attributes::CITY,
        Attributes::COUNTRY_ID,
    ];

    protected $appends = [
        Attributes::FULL_NAME,
    ];

    /**
     * Relationship: country
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, Attributes::COUNTRY_ID);
    }


    /**
     * Get Attribute: fullname
     * @param $value
     * @return string
     */
    function getFullNameAttribute($value)
    {
        return $this->name . ' (' . $this->iata . '), ' . $this->city . ', ' . $this->country->name;
    }
}
