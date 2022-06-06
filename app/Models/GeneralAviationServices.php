<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\FieldTypes;
use App\Constants\FlightType;
use App\Helpers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class GeneralAviationServices extends CustomModel
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'general_services';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        Attributes::ID,
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
        Attributes::AGENT_PHONENUMBER,
        Attributes::AGENT_ADDRESS,
        Attributes::AGENT_BILLING_ADDRESS,
        Attributes::TRANSPORT_HOTEL_NAME,
        Attributes::TRANSPORT_TIME,
        Attributes::REMARKS,
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function country()
    {
        return $this->belongsTo(Country::class,Attributes::NATIONALITY);
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    function getFlightTypeAttribute($value)
    {
        return Helpers::readableText(FlightType::getKey((int)$value));
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
