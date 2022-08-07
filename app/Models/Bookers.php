<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Bookers
 *
 * @property string first_name
 * @property string last_name
 * @property string mobile_number
 * @property string email
 */
class Bookers extends CustomModel
{

    protected $table = Tables::BOOKERS;

    protected $fillable = [
        Attributes::FIRST_NAME,
        Attributes::LAST_NAME,
        Attributes::MOBILE_NUMBER,
        Attributes::EMAIL,
        Attributes::COMMENTS,
        Attributes::SERVICE_ID,
    ];

    protected $appends = [
        Attributes::BOOKER_FULLNAME,
    ];

    /**
     * Relationship: service
     * @return BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(EliteServices::class,Attributes::SERVICE_ID);
    }

    /**
     * Get Attribute: booker_fullname
     * @param $value
     * @return string
     */
    function getBookerFullnameAttribute($value)
    {
        return $this->first_name.' '.$this->last_name;
    }
}
