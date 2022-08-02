<?php

namespace App\Http\Controllers;

use App\API\Controllers\CustomController;
use App\Constants\Attributes;
use App\Constants\CastingTypes;
use App\Constants\PaymentProvider;
use App\Constants\TransactionStatus;
use App\Helpers;
use App\Models\EliteServices;
use App\Models\Transaction;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use VIITech\Helpers\GlobalHelpers;

/**
 * Home Controller
 */
class HomeController extends CustomController
{

    /**
     * Welcome
     * @return View
     */
    function welcome()
    {
        return view('welcome');
    }

    /**
     * Home
     * @return RedirectResponse
     */
    function home()
    {
        return redirect()->to("/");
    }

    /**
     * Process
     * @return RedirectResponse
     */
    function process()
    {

        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::query()->orderByDesc(Attributes::CREATED_AT)->first();
        // generate payment link
        $link = $elite_service->generatePaymentLink();

        // redirect to
        return redirect()->to($link);

    }

    /**
     * Pay
     * @param Request $request
     * @param $uuid
     * @return RedirectResponse
     */
    function pay(Request $request, $uuid)
    {

        if (empty($uuid)) {
            return redirect()->to(env("WEBSITE_URL") . "/link-expired");
        }

        // validate signature
        if (!$request->hasValidSignature()) {
            return redirect()->to(env("WEBSITE_URL") . "/link-expired");
        }

        // get elite service
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::where(Attributes::UUID, $uuid)->first();
        if (is_null($elite_service)) {
            return redirect()->to(env("WEBSITE_URL") . "/link-expired");
        }

        // get transaction
        Transaction::createOrUpdate([
            Attributes::ELITE_SERVICE_ID => $elite_service->id,
            Attributes::AMOUNT => $elite_service->total,
            Attributes::ORDER_ID => Helpers::generateOrderID(new Transaction(), Attributes::ORDER_ID),
            Attributes::PAYMENT_PROVIDER => PaymentProvider::CREDIMAX,
            Attributes::UUID => $elite_service->uuid,
            Attributes::STATUS => TransactionStatus::PENDING
        ], [
            Attributes::ELITE_SERVICE_ID,
            Attributes::UUID,
            Attributes::AMOUNT,
        ]);

        // redirect to page
        return redirect()->to(url("/elite-service/$uuid/pay/process"));
    }

    /**
     * Process Payment
     * @param Request $request
     * @param $uuid
     * @return RedirectResponse
     */
    function processPayment(Request $request, $uuid)
    {

        // get payment method
        $payment_method = $request->get(Attributes::PAYMENT_METHOD);
        switch ($payment_method) {
            case PaymentProvider::CREDIMAX:
            default:
                $payment_method = PaymentProvider::CREDIMAX;
                break;
            case PaymentProvider::BENEFIT:
                $payment_method = PaymentProvider::BENEFIT;
                break;
        }

        // get uuid
        if (empty($uuid)) {
            dd("empty uuid");
            return redirect()->to(env("WEBSITE_URL") . "/link-expired");
        }

        // get elite service
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::where(Attributes::UUID, $uuid)->first();
        if (is_null($elite_service)) {
            dd("empty elite service");
            return redirect()->to(env("WEBSITE_URL") . "/link-expired");
        }

        // get transaction
        /** @var Transaction $transaction */
        $transaction = Transaction::where(Attributes::ELITE_SERVICE_ID, $elite_service->id)->first();
        if (is_null($transaction)) {
            // create transaction
            Transaction::createOrUpdate([
                Attributes::ELITE_SERVICE_ID => $elite_service->id,
                Attributes::AMOUNT => $elite_service->total,
                Attributes::ORDER_ID => Helpers::generateOrderID(new Transaction(), Attributes::ORDER_ID),
                Attributes::PAYMENT_PROVIDER => PaymentProvider::CREDIMAX,
                Attributes::UUID => $elite_service->uuid,
                Attributes::STATUS => TransactionStatus::PENDING
            ], [
                Attributes::ELITE_SERVICE_ID,
                Attributes::UUID,
                Attributes::AMOUNT,
            ]);
        }

        // redirect to payment gateway
        if ($payment_method == PaymentProvider::CREDIMAX) {

            // build url query
            $query = http_build_query([
                Attributes::RETURN_URL => url("elite-service/$uuid/pay/complete"),
                Attributes::AMOUNT => $transaction->amount,
                Attributes::ORDER_ID => $transaction->order_id,
                Attributes::DESCRIPTION => "Awal Private Terminal Elite Services",
            ]);

            // go to payment page
            return redirect()->to(env("CREDIMAX_URL") . "/checkout?$query");

        } else if ($payment_method == PaymentProvider::BENEFIT) {

            // TODO implement benefit
            $success_url = "/payment-received";
            $error_url = "/payment-failed";

            // go to payment page
            $payment_url = self::generateBenefitPaymentLink($transaction->amount, $elite_service->uuid, $success_url, $error_url);
        }


        // redirect to link expired
        return redirect()->to(env("WEBSITE_URL") . "/link-expired");

    }


    /**
     * Generate Benefit Payment Link
     * @return string
     */
    static function generateBenefitPaymentLink($amount, $uid, $success_url, $error_url)
    {

        try {

            // and will call the benefit middle ware on this case to generate a payment page url
            $benefit_request_data = [
                Attributes::AMOUNT => $amount,
                Attributes::ORDER_ID => $uid,
                Attributes::TRACKID => $uid,
//                Attributes::CUSTOMER_NAME => $customer_name,
//                Attributes::CUSTOMER_PHONE_NUMBER => $customer_phone_number,
                Attributes::PAYMENT_SECRET => env("PAYMENT_SECRET", 'FzpTv!dEiVC_i.Cp7nQgQH-UWW63LE_tdVtUA9v4Xr!uum6tcJ'),
                Attributes::BENEFIT_MIDDLEWARE_TOKEN => env("PAYMENT_SECRET", 'FzpTv!dEiVC_i.Cp7nQgQH-UWW63LE_tdVtUA9v4Xr!uum6tcJ'),
                Attributes::SUCCESS_URL => $success_url,
                Attributes::ERROR_URL => $error_url,
                Attributes::MERCHANT_ID => env("BENEFIT_MERCHANT_ID", "12818950")
            ];

            $benefit_request_data = Helpers::array_to_multipart_array($benefit_request_data);

            $url = env('PAYMENT_URL') . '/benefit/checkout';

            $client = new Client(['auth' => ['awal', 'password']]);
            $response = $client->request('POST', $url, [
                'multipart' => $benefit_request_data
            ]);

            $response_body = json_decode($response->getBody()->getContents());

            return $response_body->data->payment_page ?? null;

        } catch (Exception|GuzzleException $e) {
            Helpers::captureException($e);
        }

        return null;
    }


    /**
     * Complete Payment
     * @param Request $request
     * @param $uuid
     * @return RedirectResponse
     */
    function completePayment(Request $request, $uuid)
    {

        // get elite service
        /** @var EliteServices $elite_service */
        $elite_service = EliteServices::where(Attributes::UUID, $uuid)->first();
        if (is_null($elite_service)) {
            return redirect()->to(env("WEBSITE_URL") . "/payment-failed");
        }

        // get values
        $success = GlobalHelpers::getValueFromHTTPRequest($request, Attributes::SUCCESS, false, CastingTypes::BOOLEAN);
        $order_id = GlobalHelpers::getValueFromHTTPRequest($request, Attributes::ORDER_ID, false, CastingTypes::STRING);

        // get transaction
        $transaction = Transaction::where(Attributes::ORDER_ID, $order_id)->where(Attributes::ELITE_SERVICE_ID, $elite_service->id)->first();
        if (is_null($transaction)) {
            return redirect()->to(env("WEBSITE_URL") . "/payment-failed");
        }

        // update transaction status
        $transaction->status = $success;
        $transaction->save();

        // update elite service
        $elite_service->markAsPaid();

        // return response
        return redirect()->to(env("WEBSITE_URL") . "/payment-received");

    }
}
