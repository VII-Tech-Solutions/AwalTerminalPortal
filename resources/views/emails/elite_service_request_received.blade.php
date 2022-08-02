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
    @if($data[1])
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Flight Status: Arrival</p>
    </div>
    @endif
    @if(!$data[1])
        <div>
            <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Flight Status: Departure </p>
        </div>
    @endif
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Arriving From: Dubai International Airport</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Date: {{ Carbon\Carbon::createFromFormat('d MM y',$data[2]) }}</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Time: {{$data[3]}}</p>
    </div>
    <div style="padding-bottom: 20px">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Flight Number: {{$data[4]}}</p>
    </div>


    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Adults: {{$data[5]}}</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Children: {{$data[6]}}</p>
    </div>
    <div style="padding-bottom: 20px">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Infants: {{$data[7]}}</p>
    </div>
@foreach( $data[8] as $key => $value)
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Passenger {{$key+1}}</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Title: {{$value['title']}}
         </p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">First Name: {{$value['first_name']}}</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Last Name: {{$value['last_name']}}</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Date of Birth: {{$value['birth_date']}}</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Nationality: </p>
    </div>
    <div style="padding-bottom: 20px">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Class: {{$value['flight_class']}}</p>
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
