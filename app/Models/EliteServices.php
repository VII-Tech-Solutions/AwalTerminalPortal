<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\FlightType;
use App\Constants\Tables;
use App\Constants\Values;
use App\Helpers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\URL;

/**
 * Elite Services
 *
 * @property string uuid
 * @property string flight_type
 */
class EliteServices extends CustomModel
{
    use HasFactory;

    protected $table = Tables::ELITE_SERVICES;

    protected $fillable = [
        Attributes::FLIGHT_TYPE,
        Attributes::DATE,
        Attributes::TIME,
        Attributes::FLIGHT_NUMBER,
        Attributes::PASSENGER,
        Attributes::NUMBER_OF_ADULTS,
        Attributes::NUMBER_OF_CHILDREN,
        Attributes::NUMBER_OF_INFANTS,
        Attributes::UUID,
    ];

    protected $appends = [
        Attributes::FLIGHT_TYPE_NAME
    ];

    /**
     * Boot
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Helpers::setGeneratedUUID($model);
        });
        static::created(function ($model) {
            Helpers::setGeneratedUUID($model);
        });
    }

    /**
     * Relationship: country
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, Attributes::NATIONALITY);
    }

    /**
     * Get Attribute: flight_type_name
     * @return string
     */
    function getFlightTypeNameAttribute()
    {
        $flight_type = $this->flight_type;
        return Helpers::readableText(FlightType::getKey($flight_type));
    }

    /**
     * Generate Payment Link
     * @return string
     */
    function generatePaymentLink(){

        // generate uuid if doesnt exist
        if(is_null($this->uuid)){
            Helpers::setGeneratedUUID($this);
            $this->save();
        }

        // generate url
        return URL::temporarySignedRoute(
            'elite-service-payment', now()->addHours(Values::PAYMENT_EXPIRES), [
                Attributes::UUID => $this->uuid
            ]
        );
    }
}
