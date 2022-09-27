<?php

namespace App\Models;

use App\API\Controllers\EliteServiceController;
use App\Constants\Attributes;
use App\Constants\CastingTypes;
use App\Constants\ESStatus;
use App\Constants\FlightType;
use App\Constants\PaymentProvider;
use App\Constants\Tables;
use App\Constants\TransactionStatus;
use App\Constants\Values;
use App\Helpers;
use App\Mail\ESBookingApproveMail;
use App\Mail\ESBookingRejectUpdateMail;
use App\Mail\ESRequestReceivedMail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\URL;
use VIITech\Helpers\GlobalHelpers;

/**
 * Elite Services
 *
 * @property integer id
 * @property string uuid
 * @property string flight_type
 * @property string vat_amount
 * @property string subtotal
 * @property string date
 * @property string time
 * @property string flight_number
 * @property Collection bookers
 * @property int submission_status_id
 * @property int service_id
 * @property int is_arrival_flight
 * @property int number_of_infants
 * @property int number_of_children
 * @property int number_of_adults
 * @property mixed total
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
        Attributes::SUBTOTAL,
        Attributes::VAT_AMOUNT,
        Attributes::TOTAL,
        Attributes::OFFLINE_PAYMENT_METHOD,
        Attributes::PAYMENT_NOTES,
        Attributes::LINK_EXPIRES_AT
    ];

    protected $appends = [
        Attributes::FLIGHT_TYPE_NAME,
        Attributes::PAYMENT_LINK,
    ];

    protected $casts = [
        Attributes::TRANSACTIONS => CastingTypes::ARRAY,
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
        return $this->belongsTo(EliteServiceTypes::class, Attributes::SERVICE_ID);
    }

    /**
     * @return HasMany
     */
    public function passengers()
    {
        return $this->hasMany(Passengers::class, Attributes::SERVICE_ID);
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
        return $this->belongsTo(SubmissionStatus::class, Attributes::SUBMISSION_STATUS_ID);
    }

    /**
     * @return hasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, Attributes::ELITE_SERVICE_ID, Attributes::ID);
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
    function generatePaymentLink($uuid = null)
    {

        if (is_null($uuid)) {
            $uuid = $this->uuid;
        }

        // generate uuid if doesnt exist
        if (empty($uuid)) {
            Helpers::setGeneratedUUID($this);
            $this->save();
            $uuid = $this->uuid;
        }

        if (empty($uuid)) {
            return null;
        }

        $expires_at = now()->addHours(Values::PAYMENT_EXPIRES);

        $this->link_expires_at = $expires_at;
        $this->save();

        // generate url
        return URL::temporarySignedRoute(
            'elite-service-payment', $expires_at, [
                Attributes::UUID => $uuid
            ]
        );
    }

    /**
     * Attribute: payment_link
     * @return string
     */
    function getPaymentLinkAttribute()
    {
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
    static function changeStatus($id, $name, $email, $status, $rejection_reason = null)
    {
        switch ($status) {
            case ESStatus::PENDING_APPROVAL:
                $elite_service = EliteServices::query()->where(Attributes::ID, $id)->first();
                $booker = $elite_service->booker()->first();
                $total = $elite_service->total;
                $is_arrival_flight = $elite_service->is_arrival_flight;
                $date = $elite_service->date;
                $time = $elite_service->time;
                $flight_number = $elite_service->flight_number;
                $number_of_adults = $elite_service->number_of_adults;
                $number_of_children = $elite_service->number_of_children;
                $number_of_infants = $elite_service->number_of_infants;
                $from_airport_id = Airport::query()::where(Attributes::ID, $elite_service->airport_id)->first();
                $passengers = $elite_service->passengers();

                Helpers::sendMailable(new ESRequestReceivedMail($booker->email, $booker->first_name . ' ' . $booker->last_name, [$total, $is_arrival_flight, $date, $time, $flight_number, $number_of_adults, $number_of_children, $number_of_infants, $passengers, $from_airport_id]), $booker->email);
                Helpers::sendMailable(new ESRequestReceivedMail($booker->email, $booker->first_name . ' ' . $booker->last_name, [$total, $is_arrival_flight, $date, $time, $flight_number, $number_of_adults, $number_of_children, $number_of_infants, $passengers, $from_airport_id]), $booker->email);
                break;
            case ESStatus::REJECTED:
                Helpers::sendMailable(new ESBookingRejectUpdateMail($email, $name, $rejection_reason, []), $email);
                break;
            case ESStatus::APPROVED:
                /** @var EliteServices $elite_service */

                $elite_service = EliteServices::query()->where(Attributes::ID, $id)->first();

                $user = Bookers::query()->where(Attributes::ID, $elite_service->id)->first();
                $link = $elite_service->generatePaymentLink($elite_service->uuid);
                $redirectUrl = env('WEBSITE_URL') . "/elite-service?uuid=$elite_service->uuid";
                $amount = $elite_service->total;
                Helpers::sendMailable(new ESBookingApproveMail($user->email, $user->first_name, [$redirectUrl, $amount]), $user->email);
                break;
            case ESStatus::PAID:
                $elite_service = EliteServices::query()->where(Attributes::ID, $id)->first();
                $elite_service->link_expires_at = null;
                $elite_service->submission_status_id = ESStatus::PAID;
                $elite_service->save();

                $transaction = Transaction::query()->where(Attributes::ELITE_SERVICE_ID, $elite_service->id)->first();
                if (is_null($transaction)) {
                    $transaction = Transaction::createOrUpdate([
                        Attributes::ELITE_SERVICE_ID => $elite_service->id,
                        Attributes::AMOUNT => $elite_service->total,
                        Attributes::ORDER_ID => Helpers::generateOrderID(new Transaction(), Attributes::ORDER_ID),
                        Attributes::PAYMENT_PROVIDER => PaymentProvider::OTHER,
                        Attributes::UUID => $elite_service->uuid,
                        Attributes::STATUS => TransactionStatus::SUCCESS
                    ], [
                        Attributes::ELITE_SERVICE_ID,
                        Attributes::UUID,
                        Attributes::AMOUNT,
                    ]);
                }

                Artisan::call('send:receipt_email', ['transaction_id' => $transaction->id]);
                break;
        }
    }

    /**
     * Change Price and Passengers
     * @param $id
     * @param $passengers
     *
     */
    static function changePriceAndPassengers($id, $passengers, $service_id)
    {
        $elite_service = EliteServices::query()->where(Attributes::ID, $id)->first();
        $number_of_infants = 0;
        $number_of_children = 0;
        $number_of_adults = 0;
        foreach ($passengers as $passenger) {
            $birth_date = GlobalHelpers::getValueFromHTTPRequest($passenger, Attributes::BIRTH_DATE, null, \VIITech\Helpers\Constants\CastingTypes::STRING);

            $birth_date = Carbon::parse($birth_date);
            $current_date = Carbon::now();
            $age = $current_date->year - $birth_date->year;

            if ($age < 3) {
                $number_of_infants += 1;
            } elseif ($age <= 12) {
                $number_of_children += 1;
            } else {
                $number_of_adults += 1;
            }
        }

        if (is_null($service_id)) {
            $service_id = $elite_service->service_id;
        }

        $subtotal = 0;
        $adult_priced_passengers = $number_of_children + $number_of_adults;
        $selected_service = EliteServiceTypes::where(Attributes::ID, $service_id)->get();
        $price_per_adult = $selected_service->first()->price_per_adult;

        if ($service_id == 1) {
            if ($adult_priced_passengers > 4) {
                $subtotal += $price_per_adult;

                $extra_adult_passengers = $adult_priced_passengers - 4;
                $subtotal += ($extra_adult_passengers * 20);

            } else {
                $subtotal += $price_per_adult;
            }
        } else if ($service_id == 2) {
            if ($adult_priced_passengers > 4) {
                $subtotal += $price_per_adult;

                $extra_adult_passengers = $adult_priced_passengers - 4;
                $subtotal += ($extra_adult_passengers * 25);
            } else {
                $subtotal += $price_per_adult;
            }
        }

        $values = EliteServiceController::calculateVAT($subtotal);
        $vat_amount = $values[Attributes::VAT_AMOUNT];
        $total = $vat_amount + $subtotal;


        $elite_service->number_of_infants = $number_of_infants;
        $elite_service->number_of_children = $number_of_children;
        $elite_service->number_of_adults = $number_of_adults;
        $elite_service->subtotal = $subtotal;
        $elite_service->total = $total;
        $elite_service->vat_amount = $vat_amount;
        $elite_service->service_id = $service_id;
        $elite_service->save();

        return [$number_of_infants, $number_of_children, $number_of_adults, $subtotal, $total, $vat_amount, $service_id];
    }


    /**
     * Mark As Paid
     */
    function markAsPaid()
    {

        // change status
        $this->submission_status_id = ESStatus::PAID;
        $this->save();

        // send email
        /** @var Bookers $booker */
        $booker = $this->booker()->first();
        if (!is_null($booker)) {
            EliteServices::changeStatus($this->id, $booker->first_name, $booker->email, ESStatus::PAID, null);
        }
    }
}
