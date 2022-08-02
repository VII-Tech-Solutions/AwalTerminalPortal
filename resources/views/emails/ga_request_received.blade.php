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
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41"> Thanks for your interest in Awal Private Terminal. We have received your request and it is under review.</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">A member of our team is reviewing your submission and will get in contact with you shortly.</p>
    </div>


    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Here is an overview of all the details you submitted:</p>
    </div>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Aircraft Type:
{{--            {{$data[1]}}</p>--}}
    </div>
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Registration:--}}
{{--            {{$data[2]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">MTOW (KG):--}}
{{--            {{$data[3]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Lead Passenger Name:--}}
{{--            {{$data[4]}}</p>--}}
{{--    </div>--}}
{{--    <div style="padding-bottom: 20px">--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Purpose of Landing:--}}
{{--            {{$data[5]}}</p>--}}
{{--    </div>--}}



{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Arrival:</p>--}}
{{--    </div>--}}

{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Call Sign:--}}
{{--            {{$data[6]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">From Airport:--}}
{{--            {{$data[7]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">ETA (UTC Time):--}}
{{--            {{$data[8]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Arrival Date:--}}
{{--            {{$data[9]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Nature of Flight:--}}
{{--            {{$data[10]}}</p>--}}
{{--    </div>--}}
{{--    <div style="padding-bottom: 20px">--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Passenger Count:--}}
{{--            {{$data[11]}}</p>--}}
{{--    </div>--}}


{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Departure:</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Call Sign:--}}
{{--            {{$data[12]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">To Airport:--}}
{{--            {{$data[13]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">ETD (UTC Time):--}}
{{--            {{$data[14]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Departure Date:--}}
{{--            {{$data[15]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Nature of Flight:--}}
{{--            {{$data[16]}}</p>--}}
{{--    </div>--}}
{{--    <div style="padding-bottom: 20px">--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Passenger Count:--}}
{{--            {{$data[17]}}</p>--}}
{{--    </div>--}}




{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Operator:</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Full Name:--}}
{{--            {{$to_name}}</p>--}}
{{--    </div>    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Country:--}}
{{--            {{$data[18]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Telephone Number:--}}
{{--            {{$data[19]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Email Address:--}}
{{--            {{$data[20]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Address:--}}
{{--            {{$data[21]}}</p>--}}
{{--    </div>--}}
{{--    <div style="padding-bottom: 20px">--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Billing Address:--}}
{{--            {{$data[22]}}</p>--}}
{{--    </div>--}}




{{--@if( $data[23])--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Agent:</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Full Name:--}}
{{--            {{$data[0]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Country:--}}
{{--            {{$data[24]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Telephone Number:--}}
{{--            {{$data[26]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Email Address:--}}
{{--            {{$data[25]}}</p>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Address:--}}
{{--            {{$data[27]}}</p>--}}
{{--    </div>--}}
{{--    <div style="padding-bottom: 20px">--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Billing Address:--}}
{{--            {{$data[28]}}</p>--}}
{{--    </div>--}}

{{--@endif--}}

{{--    <div>--}}
{{--        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">List of Services:--}}
{{--            {{$services}}</p>--}}
{{--    </div>--}}

    <br>

    <br>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">If you require any further assistance, please contact the Bookings Team on Tel: +973 17139831 or Mobile: +973 39471116 or mail us at elite@halabahrain.bh.</p>
    </div>
    <br>
@endsection
