<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\ESStatus;
use App\Constants\FlightType;
use App\Constants\Tables;
use App\Constants\Values;
use App\Helpers;
use App\Mail\ESBookingApproveMail;
use App\Mail\ESBookingRejectUpdateMail;
use App\Mail\ESRequestReceivedMail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;

/**
 * Elite Services
 *
 * @property string uuid
 * @property string flight_type
 * @property Collection bookers
 * @property int submission_status_id
 */
class EliteServices extends CustomModel
{

    protected $table = Tables::ELITE_SERVICES;

    protected $fillable = [
        Attributes::SERVICE_ID,
        Attributes::AIRPORT_ID,
        Attributes::FLIGHT_TYPE,
        Attributes::IS_ARRIVAL_FLIGHT,
        Attributes::DATE,
        Attributes::TIME,
        Attributes::FLIGHT_NUMBER,
        Attributes::PASSENGER,
        Attributes::NUMBER_OF_ADULTS,
        Attributes::NUMBER_OF_CHILDREN,
        Attributes::NUMBER_OF_INFANTS,
        Attributes::SUBMISSION_STATUS_ID,
        Attributes::UUID,
        Attributes::REJECTION_REASON,
    ];

    protected $appends = [
        Attributes::FLIGHT_TYPE_NAME,
        Attributes::PAYMENT_LINK,
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
     * @return BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(EliteServiceTypes::class,Attributes::SERVICE_ID);
    }

    /**
     * @return HasMany
     */
    public function passengers()
    {
        return $this->hasMany(Passengers::class,Attributes::SERVICE_ID);
    }

    /**
     * @return HasMany
     */
    public function booker()
    {
        return $this->HasMany(Bookers::class, Attributes::SERVICE_ID);
    }

    /**
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(SubmissionStatus::class,Attributes::SUBMISSION_STATUS_ID);
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
    function generatePaymentLink($uuid = null){

        if(is_null($uuid)){
            $uuid = $this->uuid;
        }

        // generate uuid if doesnt exist
        if(empty($uuid)){
            Helpers::setGeneratedUUID($this);
            $this->save();
            $uuid = $this->uuid;
        }

        if(empty($uuid)){
            return null;
        }

        // generate url
        return URL::temporarySignedRoute(
            'elite-service-payment', now()->addHours(Values::PAYMENT_EXPIRES), [
                Attributes::UUID => $uuid
            ]
        );
    }

    /**
     * Attribute: payment_link
     * @return string
     */
    function getPaymentLinkAttribute(){
        $uuid = $this->uuid;
        return url("/elite-service/$uuid/pay/process");
    }

    /**
     * Change Status
     * @param $id
     * @param $name
     * @param $email
     * @param $status
     * @param $rejection_reason
     */
    static function changeStatus($id, $name, $email, $status, $rejection_reason = null){
        switch ($status) {
            case ESStatus::PENDING_APPROVAL:
                Helpers::sendMailable(new ESRequestReceivedMail($email, $name, []), $email);
                break;
            case ESStatus::REJECTED:
                Helpers::sendMailable(new ESBookingRejectUpdateMail($email, $name, $rejection_reason, []), $email);
                break;
            case ESStatus::APPROVED:
                /** @var EliteServices $elite_service */
                $elite_service = EliteServices::query()->where(Attributes::ID, $id)->first();
                $user = Bookers::query()->where(Attributes::ID, $elite_service->id)->first();
                $link = $elite_service->generatePaymentLink($elite_service->uuid);
                Helpers::sendMailable(new ESBookingApproveMail($user->email, $user->first_name, [$link]), $user->email);
                break;
            case ESStatus::PAID:
                // TODO paid
                break;
        }
    }

    /**
     * Mark As Paid
     */
    function markAsPaid(){

        // change status
        $this->submission_status_id = ESStatus::REJECTED;
        $this->save();

        // send email
        /** @var Bookers $booker */
        $booker = $this->booker()->first();
        if(!is_null($booker)){
            EliteServices::changeStatus($this->id, $booker->first_name, $this->email, ESStatus::PAID, null);
        }
    }
}
