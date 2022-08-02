@extends('emails.layout')
@section('content')
    <div style="display: flex">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Hi &nbsp;</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #4e89e8">{{$to_name}}</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">,</p>
    </div>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Thanks for your interest in Awal Private Terminal. We are pleased to receive your request and to confirm that it is being processed.</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Once it is approved, we will send you an email to complete the payment process and reserve your booking.</p>
    </div>

    <br>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Here is an overview of all the details you submitted:</p>
    </div>
    @if($data[4])
    <div>
        Flight Status: Arrival
    </div>
    @endif
    <div>
        Arriving From: Dubai International Airport
    </div>
    <div>
        Date: {{$data[1]}}
    </div>
    <div>
        Time: {{$data[2]}}
    </div>
    <div style="padding-bottom: 20px">
        Flight Number: {{$data[3]}}
    </div>


    <div>
        Adults: {{$data[5]}}
    </div>
    <div>
        Children: {{$data[6]}}
    </div>
    <div style="padding-bottom: 20px">
        Infants: {{$data[7]}}
    </div>

@foreach($data[8] as $key=>$value)
    <div>
        Passenger {{$key++}}
    </div>
    <div>
        Title: {{$value[$title]}}.
    </div>
    <div>
        First Name: {{$value[$first_name]}}
    </div>
    <div>
        Last Name: {{$value[$last_name]}}
    </div>
    <div>
        Date of Birth: {{$value[$birth_date]}}
    </div>
    <div>
        Nationality: {{$value[$nationality_id]}}
    </div>
    <div style="padding-bottom: 20px">
        Class: {{$value[$flight_class]}}
    </div>
@endforeach


    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">The total amount you are required to pay is BHD{{$data[0]}}.</p>
    </div>
    <br>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">If you require any further assistance, please contact the Bookings Team on Tel: +973 17139831 or Mobile: +973 39471116 or mail us at elite@halabahrain.bh.</p>
    </div>
    <br>

@endsection
