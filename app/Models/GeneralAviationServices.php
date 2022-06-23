<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\CastingTypes;
use App\Constants\FlightType;
use App\Constants\Tables;
use App\Helpers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * General Aviation Services
 *
 * @property Collection attachments
 */
class GeneralAviationServices extends CustomModel
{

    protected $table = Tables::GA;

    protected $fillable = [
        Attributes::AIRCRAFT_TYPE,
        Attributes::REGISTRATION_NUMBER,
        Attributes::MTOW,
        Attributes::LEAD_PASSENGER_NAME,
        Attributes::LANDING_PURPOSE,
        Attributes::ARRIVAL_CALL_SIGN,
        Attributes::ARRIVING_FROM_AIRPORT,
        Attributes::ESTIMATED_TIME_OF_ARRIVAL,
        Attributes::ARRIVAL_DATE,
        Attributes::ARRIVAL_FLIGHT_NATURE,
        Attributes::ARRIVAL_PASSENGER_COUNT,
        Attributes::DEPARTURE_CALL_SIGN,
        Attributes::DEPARTURE_TO_AIRPORT,
        Attributes::ESTIMATED_TIME_OF_DEPARTURE,
        Attributes::DEPARTURE_DATE,
        Attributes::DEPARTURE_FLIGHT_NATURE,
        Attributes::DEPARTURE_PASSENGER_COUNT,
        Attributes::OPERATOR_FULL_NAME,
        Attributes::OPERATOR_COUNTRY,
        Attributes::OPERATOR_TEL_NUMBER,
        Attributes::OPERATOR_EMAIL,
        Attributes::OPERATOR_ADDRESS,
        Attributes::OPERATOR_BILLING_ADDRESS,
        Attributes::IS_USING_AGENT,
        Attributes::AGENT_FULLNAME,
        Attributes::AGENT_COUNTRY,
        Attributes::AGENT_EMAIL,
        Attributes::AGENT_PHONENUMBER,
        Attributes::AGENT_ADDRESS,
        Attributes::AGENT_BILLING_ADDRESS,
        Attributes::TRANSPORT_HOTEL_NAME,
        Attributes::TRANSPORT_TIME,
        Attributes::STATUS,
        Attributes::REMARKS,
        Attributes::SUBMISSION_STATUS_ID,
        Attributes::REJECTION_REASON,
    ];

    protected $casts = [
        Attributes::ATTACHMENTS => CastingTypes::ARRAY,
        Attributes::SERVICES => CastingTypes::ARRAY,
    ];

    /**
     * Relationship: country
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class,Attributes::NATIONALITY);
    }

    /**
     * Relationship: attachments
     * @return HasMany
     */
    function attachments(){
        return $this->hasMany(Attachment::class, Attributes::FORM_ID, Attributes::ID);
    }

    /**
     * Relationship: arriving_from_airport
     * @return BelongsTo
     */
    public function arriving_from_airport()
    {
        return $this->belongsTo( Airport::class,Attributes::ID, Attributes::ARRIVING_FROM_AIRPORT);
    }

    /**
     * Relationship: departing_to_airport
     * @return BelongsTo
     */
    public function departing_to_airport()
    {
        return $this->belongsTo(Airport::class,Attributes::ID, Attributes::ARRIVING_FROM_AIRPORT);
    }

    /**
     * Relationship: agent_country
     * @return BelongsTo
     */
    public function agent_country()
    {
        return $this->belongsTo(Country::class,Attributes::ID, Attributes::AGENT_COUNTRY);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(FormServices::class,Tables::GA_SERVICES,Attributes::GENERAL_AVIATION_ID,Attributes::ID);
    }

    /**
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(SubmissionStatus::class,Attributes::SUBMISSION_STATUS_ID);
    }


    /**
     * Relationship: operator_country
     * @return BelongsTo
     */
   public function operator_country()
    {
        return $this->belongsTo(Country::class,Attributes::ID, Attributes::OPERATOR_COUNTRY);
    }

    /**
     * Get Attribute: flight_type
     * @param $value
     * @return string
     */
    function getFlightTypeAttribute($value)
    {
        return Helpers::readableText(FlightType::getKey((int)$value));
    }

}
