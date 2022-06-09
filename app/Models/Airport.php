<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Airport
 */
class Airport extends CustomModel
{
    use CrudTrait;

    protected $table = Tables::AIRPORTS;

    protected $fillable = [
        Attributes::NAME,
        Attributes::COUNTRY_ID
    ];

    /**
     * Relationship: country
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, Attributes::COUNTRY_ID);
    }
}
