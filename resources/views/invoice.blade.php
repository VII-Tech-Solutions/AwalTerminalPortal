@php $url = url(""); @endphp
    <!DOCTYPE html>
<html>
<head>
    <title>Awal Private Terminal</title>
    <meta charset='utf-8'/>
    <style>
        @font-face {
            font-family: "Frutiger LT Arabic";
            src: url("{{$url}}/assets/fonts/frutiger-lt-arabic-55-roman.ttf") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: "Frutiger LT Arabic";
            src: url("{{$url}}/assets/fonts/frutiger-lt-arabic-65-bold.ttf") format("truetype");
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: "Frutiger LT Arabic";
            src: url("{{$url}}/assets/fonts/frutiger-lt-arabic-75-black.ttf") format("truetype");
            font-weight: 900;
            font-style: normal;
        }
        .confirmation {
            font-family: 'Frutiger LT Arabic';
        }
        .confirmation .complete-booking-title {
            font-family:  'Frutiger LT Arabic';
            font-size: 40px;
            font-weight: 900;
            font-stretch: normal;
            font-style: normal;
            line-height: 2;
        }

        .bold{
            font-weight: bold !important;
        }

        .price {
            font-size: 16px !important;
        }

        .complete-booking-title2 {
            width: 125px;
            height: 24px;
            margin: 40px 0 19px 335px;
            font-family: 'Frutiger LT Arabic';
            font-size: 20px;
            font-weight: bold;
            font-stretch: normal;
            font-style: normal;
            line-height: 1.2;
            letter-spacing: normal;
            text-align: right;
            color: #000000;
        }

        .confirmation .page-content {
            display: flex;
            /*margin-top: 40px;*/
            flex-direction: column;
            align-items: center;
            padding-bottom: 26px;
            width: 555px;
            margin-right: auto;
            margin-left: auto;
        }

        .confirmation .page-content .header-details {
            position: relative;
            align-items: center;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            flex-direction: row-reverse;
            /*margin-top: 40px;*/
        }

        .confirmation .page-content .logo {
            margin: 20px;
            display: flex !important;
            justify-content: end;
            width: 535px;
            margin-right: unset;
        }

        .confirmation .page-content .logo img{
            float: right;
        }

        .confirmation .page-content .header-details .step-title {
            color: #000000;
            font-size: 20px;
            letter-spacing: 0;
            line-height: 1.76px;
            display: flex;
            align-items: center;
            font-weight: 900;
        }

        .confirmation .page-content .confirmation-no-link {
            width: 535px;
            flex-direction: row-reverse;
            margin-left: auto;
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            margin-bottom: 30px;
        }



        .confirmation .page-content .confirmation-no-link .download-btn {
            width: 156px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .confirmation .page-content .confirmation-no-link .download-btn span {
            font-weight: 900;
        }

        .confirmation .page-content .confirmation-container {
            border: solid 2px #e5e5e5;
            border-radius: 10px;
            background-color: #FFFFFF;
            width: 495px;
            /*height: 463px;*/
            margin-bottom: 8px;
            padding: 0px 30px 24px 30px;
        }

        hr {
            color: #e5e5e5 !important;
        }

        .confirmation .page-content .confirmation-container .confirmation-text {
            padding: 10px 29px 8px;
            border-top-left-radius: 9px;
            border-top-right-radius: 9px;
            background-color: #eff9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0px -30px -15px -30px;
            flex-direction: column;
        }


        .confirmation .page-content .header-details .side-title {
            color: #808080;
            font-size: 14px;
            letter-spacing: 0;
            line-height: 1.76px;
            display: flex;
            align-items: center;
            font-weight: 900;
        }

        .confirmation .page-content .confirmation-container .confirmation-details-containers {
            display: flex;
            /*justify-content: space-between;*/
            /*margin-top: 30px;*/
            justify-content: end;
        }

        .confirmation .page-content .confirmation-container .confirmation-detail-container {
            display: flex;
            flex-direction: column;
        }

        .confirmation .page-content .confirmation-container .hr-ads-booking {
            margin-top: 20px !important;
            margin-bottom: 20px !important;
        }

        .confirmation .page-content .confirmation-container .ad-type-text {
            font-size: 12px;
            text-align: right;
            height: 36px;
            white-space: nowrap;
            font-weight: bold;
            /*line-height: 2.25;*/

            /*margin: 22px 0 0;*/
            font-family: 'Frutiger LT Arabic';
            font-stretch: normal;
            font-style: normal;
            line-height: normal;
            letter-spacing: normal;
            color: #404040;
        }
        confirmation .page-content .confirmation-container .ad-type-text-date {
            font-size: 12px;
            text-align: right;
            height: 36px;
            white-space: nowrap;
            font-weight: bold;
            /*line-height: 2.25;*/
            display: flex;

            /*margin: 22px 0 0;*/
            font-family: 'Frutiger LT Arabic';
            font-stretch: normal;
            font-style: normal;
            line-height: normal;
            letter-spacing: normal;
            color: #404040;
        }

        .details {
            justify-content: space-between !important;
            flex-direction: row-reverse;
        }
        .confirmation .page-content .confirmation-container .light-text-confirmation {
            font-size: 12px;
            /*font-weight: bold;*/
            font-stretch: normal;
            font-style: normal;
            letter-spacing: normal;
            text-align: right;
            color: #808080;
            /*margin-bottom: 4px;*/
            flex-direction: row-reverse;
            display: flex;
            /*margin: 0 0 22px 27px;*/
            font-family: 'Frutiger LT Arabic';
            font-weight: normal;
            line-height: normal;
        }

        .right {
            text-align: right;
        }

        .confirmation .page-content .confirmation-container .payment-method-details {
            width: 100%;
            padding: 18px 20px 18px 20px;
            border-radius: 10px;
            background-color: #f6f3e9;
            display: flex;
            justify-content: space-between;
        }

        .confirmation .page-content .confirmation-container .payment-method-details.cheque {
            justify-content: flex-start;
        }

        .confirmation .page-content .confirmation-container .payment-method-details.cheque .payment-method-data {
            margin-left: 82px;
        }

        .confirmation .page-content .confirmation-container .payment-method-details.cheque i {
            font-size: 30px;
            color: #e12027;
            height: 38px;
            margin-top: 2px;
            line-height: 1.5;
        }

        .confirmation .page-content .confirmation-container .payment-method-details .payment-method-data {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .confirmation .page-content .confirmation-container .payment-method-details .payment-method-data img {
            width: 38px;
            height: 38px;
        }

        .confirmation .page-content .confirmation-container .payment-method-details .normal-text {
            font-size: 16px;
            font-weight: normal;
            line-height: 2.25;
            text-align: right;
            color: #000;
            margin-bottom: 5px;
        }

        .confirmation .page-content .confirmation-container .payment-method-details .white-container {
            padding: 7px 20px 9px;
            border-radius: 10px;
            border: solid 1px #ddd;
            background-color: #fff;
            direction: ltr;
        }

        .confirmation .page-content .confirmation-container .payment-method-details .white-container span {
            font-size: 16px;
            font-weight: bold;
            line-height: 1.5;
            text-align: center;
            color: #e12027;
        }

        .confirmation .page-content .confirmation-container .ad-details-payment {
            display: flex;
            height: 46px;
            align-items: center;
            justify-content: space-between;
        }

        .confirmation .page-content .confirmation-container .ad-details-payment .ad-title-payment {
            width: 350px;
            font-size: 16px;
            font-weight: bold;
            color: #404040;
        }

        .confirmation .page-content .confirmation-container .ad-details-payment .ad-duration-payment {
            font-size: 16px;
            font-weight: normal;
            color: #808080;
            width: 54px;
        }

        .confirmation .page-content .confirmation-container .ad-details-payment .ad-price-payment {
            color: #606060;
            font-size: 16px;
            font-weight: bold;
            text-align: left;
        }

        .confirmation .page-content .confirmation-container .duration-price-container {
            display: flex;
            justify-content: space-between;
            width: 60%;
        }

        .confirmation .page-content .confirmation-container .total-price-confirmation {
            font-size: 20px;
            font-weight: 900;
            font-stretch: normal;
            font-style: normal;
            line-height: 2.3;
            letter-spacing: normal;
            text-align: right;
            color: #404040;
        }

        .confirmation .confirmation-error {
            /*padding-top: 40px;*/
        }

        .first-section {
            margin-top: 20px;
        }

        .second-section {
            margin-top: 10px;
        }

        .third-section {
            margin-top: 10px;
        }

        .last {
            width: 535px;
            display: flex;
            justify-content: end;
            font-size: 12px;
            color: #808080;
        }

    </style>
</head>
<body>
<div class="confirmation">

    <div class="page-content">
        <div style="height: 115px">
            <div class="logo">
                <img src="{{ url("/assets/images/logo.png") }}" width="48px" alt="logo">
            </div>
        </div>
        <div class="header-details confirmation-no-link">
            <div class="step-title right">
                <div class="">! تم تأكيد طلبك</div>
            </div>
        </div>
        <div class="confirmation-container">
            <div class="confirmation-details-containers first-section">
                <div class="confirmation-detail-container"  style="clear: right; height: 43px; width: 100%;">
                    <div class="light-text-confirmation" >تاريخ الطلب</div>
                    <div class="ad-type-text-date" style="float: right; height: 23px; display: flex; justify-content: end; font-size: 12px;">
                        <span>{{$order_date[2]}}</span>
                        <span>&nbsp</span>
                        <span>{{$order_date[1]}} </span>
                        <span>&nbsp</span>
                        <span>{{$order_date[0]}} </span>
                    </div>
                </div>
            </div>
            <div class="confirmation-details-containers">
                <div class="confirmation-detail-container">
                    <div class="light-text-confirmation" style="height: 23px;margin-top: 10.4px">رقم الطلب</div>
                    <div class="ad-type-text" style="height: 33px;">{{$transaction_order_id}}</div>
                </div>
            </div>
            <div class="confirmation-details-containers">
                <div class="confirmation-detail-container" style="height: 43px; margin-top: 10.4px">
                    <div class="light-text-confirmation">طريقة الدفع</div>
                    <div class="ad-type-text">{{$payment_method}}</div>
                </div>
            </div>
            <hr style="margin-top: 10.7px">
{{--            <div class="confirmation-details-containers second-section" style="height: 23px">--}}
{{--                <div class="confirmation-detail-container">--}}
{{--                    <div class="ad-type-text">{{$activity_name}}</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="confirmation-details-containers" style=" float: right">--}}
{{--                <div class="light-text-confirmation">--}}
{{--                    <span style="float: right">{{$total_people}}</span>--}}
{{--                    <span style="float: left"> أشخاص</span>--}}
{{--                </div>--}}
{{--            </div>--}}
            <br>
            <div class="confirmation-details-containers details" style="height: 23px">
{{--                <div class="light-text-confirmation" style="float: right">--}}
{{--                    <span>{{$date[3]}} </span>--}}
{{--                    <span>،</span>--}}
{{--                    <span>&nbsp</span>--}}
{{--                    <span>{{$date[0]}} </span>--}}
{{--                    <span>&nbsp</span>--}}
{{--                    <span>{{$date[1]}} </span>--}}
{{--                    <span>&nbsp</span>--}}
{{--                    <span>{{$date[2]}}</span>--}}
{{--                </div>--}}
                <div class="light-text-confirmation bold" style="float: left" >BHD {{$amount}}</div>
            </div>
            <hr>
            <div class="confirmation-details-containers third-section details" style="height: 30px" >
                <span class="ad-type-text" style="float: right">المبلغ الإجمالي</span>
                <span class="light-text-confirmation bold" style="float: left">BHD {{$amount}}</span>
                {{--                    <div class="ad-type-text">الخصم</div>--}}
                {{--                    <div class="light-text-confirmation">{{$discount}}</div>--}}
                {{--                    <div class="ad-type-text">ضريبة القيمة المضافة (%0.5)</div>--}}
                {{--                    <div class="light-text-confirmation">{{$discount}}</div>--}}
            </div>
            <div class="confirmation-details-containers third-section details" style="height: 30px" >
{{--                <span class="ad-type-text" style="float: right">الخصم</span>--}}
{{--                <span class="light-text-confirmation bold" style="float: left">BHD {{$discount}}</span>--}}
                <div class="ad-type-text">ضريبة القيمة المضافة (%0.5)</div>
                <div class="light-text-confirmation">BHD {{$vat_amount}}</div>
            </div>
            <hr>
            <div class="confirmation-details-containers third-section details" style="height: 58px; ">
                <div class="ad-type-text bold " style="float: right ">المجموع</div>
                <div class="ad-type-text bold price" style="float: left;">ِBHD {{$subtotal}}</div>
            </div>
        </div>
        <div class="confirmation-details-containers" >
{{--            <div class="light-text-confirmation last" style="float: right; display: flex; justify-content: end; text-align: right;"><span style="color: red">&hearts;</span>&nbsp b4bhcom شكرا للطلب من</div>--}}
        </div>
    </div>
</div>
</body>
</html>
