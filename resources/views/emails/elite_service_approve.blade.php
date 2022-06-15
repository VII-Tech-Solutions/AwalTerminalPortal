@extends('emails.layout')
@section('content')
    <div style="display: flex">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Hi &nbsp;</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #4e89e8">{{$to_name}}</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">,</p>
    </div>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Your booking for Elite Service at Awal Private Terminal has been approved. </p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">The total amount you are required to pay is BHD[total amount].</p>
    </div>

{{--        [reason for rejection]--}}
    <br>
        <div>
            <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">You can resubmit a request on our website and try again.</p>
        </div>
        <div>
            <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">We appreciate your understanding.</p>
        </div>
    <br>
@endsection


Hi [Booker’s First Name],

Your booking for Elite Service at Awal Private Terminal has been approved.
The total amount you are required to pay is BHD[total amount].

To confirm your booking, click on the link below to proceed with the payment:

[link to payment gateway]

Please note that this link will expire on [date email sent + 10 days]
