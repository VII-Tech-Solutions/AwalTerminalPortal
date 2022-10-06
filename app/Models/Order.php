<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use VIITech\Helpers\Constants\CastingTypes;

/**
 * Order
 *
 * @property string order_id
 * @property string success_url
 * @property string error_url
 * @property bool credimax_success_indicator
 * @property int status
 * @property string error_message
 * @property string payment_id
 */
class Order extends Model
{
    use SoftDeletes;

    protected $connection = "mysql";
    protected $table = Tables::ORDERS;

    protected $fillable = [
        Attributes::SUCCESS_INDICATOR,
        Attributes::SUCCESS_URL,
        Attributes::ERROR_URL,
        Attributes::ERROR_MESSAGE,
        Attributes::ORDER_ID,
        Attributes::AMOUNT,
        Attributes::CURRENCY,
        Attributes::SESSION_CREATED,
        Attributes::DESCRIPTION,
        Attributes::SESSION_VERSION,
        Attributes::GATEWAY,
        Attributes::UID,
        Attributes::PAYMENT_ID,
        Attributes::CUSTOMER_PHONE_NUMBER,
        Attributes::STATUS,
    ];

    protected $casts = [
        Attributes::SESSION_CREATED => CastingTypes::BOOLEAN
    ];

    /**
     * Create Order
     * @param array $data
     * @return Order|null
     */
    static function createOrder($data){

        try {
            $order = null;
            $order_id = $data[Attributes::ORDER_ID] ?? null;
            if(!is_null($order_id)){
                $order = Order::where(Attributes::ORDER_ID, $order_id)->first();
            }
            if(is_null($order)){
                $order = new Order();
            }
            $order->fill($data);
            $order->save();
            return $order;
        } catch (Exception $e) {
            return null;
        }
    }
}
