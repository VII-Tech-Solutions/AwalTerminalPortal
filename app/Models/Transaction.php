<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\PaymentProvider;
use App\Constants\Tables;
use App\Helpers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use VerumConsilium\Browsershot\Facades\PDF;

/**
 * Transaction
 *
 * @property string amount
 * @property string order_id
 * @property string uuid
 * @property integer payment_provider
 */
class Transaction extends CustomModel
{

    protected $table = Tables::TRANSACTIONS;

    protected $fillable = [
        Attributes::ID,
        Attributes::ORDER_ID,
        Attributes::ELITE_SERVICE_ID,
        Attributes::AMOUNT,
        Attributes::UUID,
        Attributes::PAYMENT_PROVIDER,
        Attributes::CREDIMAX_SUCCESS_INDICATOR,
        Attributes::STATUS,
    ];


    /**
     * Generate Receipt
     * @return string
     */
    public function generateReceipt()
    {

        $transaction_id = $this->id;

        // generate pdf
        $pdf = PDF::loadUrl(url("/api/receipt/$transaction_id"))->waitUntilNetworkIdle()
            ->inline('receipt.pdf')
            ->header('Authorization', 'Basic ' . base64_encode('awal:password'));

        // upload file
        $path = Helpers::uploadFile(null, $pdf, null, "uploads/files", true, false);

        // add to db
//        $this->receipt = $path;
//        $this->save();

        return $path;
    }

    /**
     * Generate Receipt Data
     * @return array
     */
    function generateReceiptData() {

        // get booking
        $transaction = Transaction::where(Attributes::ID, $this->id)->first();
        $eliteService = EliteServices::where(Attributes::ID, $this->order_id)->first();
        $order_date = Carbon::parse($this->created_at);

        // get payment method
        $payment_method = PaymentProvider::getKey($this->payment_provider);
        $payment_method = Helpers::readableText($payment_method);
        if(empty($payment_method)){
            $payment_method = "-";
        }


        $data = [
            Attributes::ORDER_DATE => $order_date,
            Attributes::TRANSACTION_ORDER_ID => $transaction->id,
            Attributes::PAYMENT_METHOD => $payment_method,
            Attributes::SUBTOTAL => $eliteService->subtotal ?? '436',
            Attributes::VAT_AMOUNT => $eliteService->vat_amount ?? '346',
            Attributes::AMOUNT => $this->amount,
        ];

        // return data
        return $data;
    }
}

