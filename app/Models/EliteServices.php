<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\FieldTypes;
use App\Constants\FlightType;
use App\Helpers;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class EliteServices extends CustomModel
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'elite_services';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
     protected $fillable = [
         Attributes::FLIGHT_TYPE,
         Attributes::DATE,
         Attributes::TIME,
         Attributes::FLIGHT_NUMBER,
         Attributes::PASSENGER,
         Attributes::NUMBER_OF_ADULTS,
         Attributes::NUMBER_OF_CHILDREN,
         Attributes::NUMBER_OF_INFANTS,
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
