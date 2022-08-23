@extends('emails.layout')
@section('content')
    <div style="display: flex">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Hi &nbsp;</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #4e89e8">{{$to_name}}</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">,</p>
    </div>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Your booking for Elite Service at Awal Private Terminal has been confirmed.</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">The total amount you are required to pay is BHD{{$data[1]}}</p>
    </div>

    <br>
        <div>
            <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">To confirm your booking, click on the link below to proceed with the payment:</p>
        </div>
    <br>
        <div>
            <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #4e89e8">
                <a href="{{$data[0]}}">{{$data[0]}}</a>
            </p>
        </div>
    <br>
        <div style="display: flex">
            <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Please note that this link will expire on &nbsp;</p><p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #4e89e8">{{ now()->addDays(3)->format('Y-m-d') }}</p>
        </div>
    <br>

    <div style="display: flex">
            <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">To get the booking confirmation, the payment must be made within 72 hours of the confirmation. In the case where you have failed to arrive, the amount will be charged in full if the booking was not cancelled 8 hours in advance.
            </p>
        </div>
    <br>
@endsection
