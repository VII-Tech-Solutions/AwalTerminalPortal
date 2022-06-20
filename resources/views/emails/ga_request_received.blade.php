@extends('emails.layout')
@section('content')
    <p style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif;color: #011e41">General
        Aviation Request</p>

    <div style="display: flex">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Hi
            &nbsp;</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #4e89e8">{{$to_name}}
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">&nbsp;
            or &nbsp;</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #4e89e8">{{$data[0]}}</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">,</p>
    </div>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Thanks
            for your interest in Awal Private Terminal. We have received your request and it is under review.</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">A
            member of our team is reviewing your submission and will get in contact with you shortly.</p>
    </div>

    <br>
    {{--    <div>--}}
    {{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41"> Here is an overview all the details you submitted:</p>--}}
    {{--    </div>--}}
    {{--    [Booking details]--}}

    <br>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">If you
            require any further assistance, please contact the Bookings Team.</p>
    </div>
    <br>
@endsection
