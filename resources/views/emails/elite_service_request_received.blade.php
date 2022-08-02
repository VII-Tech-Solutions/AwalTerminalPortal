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
    <div>
        Flight Status: Arrival
    </div>
    <div>
        Arriving From: Dubai International Airport
    </div>
    <div>
        Date: 24 April, 2022
    </div>
    <div>
        Time: 4E89E8
    </div>
    <div style="padding-bottom: 20px">
        Flight Number: BA2490A
    </div>


    <div>
        Adults: 2
    </div>
    <div>
        Children: 1
    </div>
    <div style="padding-bottom: 20px">
        Infants: 0
    </div>


    <div>
        Passenger 1
    </div>
    <div>
        Title: Mr.
    </div>
    <div>
        First Name: Ahmad
    </div>
    <div>
        Last Name: Yusuf
    </div>
    <div>
        Date of Birth: 27 October, 1991
    </div>
    <div>
        Nationality: Bahraini
    </div>
    <div style="padding-bottom: 20px">
        Class: Economy
    </div>



    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">The total amount you are required to pay is BHD{{$data[0]}}.</p>
    </div>
    <br>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">If you require any further assistance, please contact the Bookings Team on Tel: +973 17139831 or Mobile: +973 39471116 or mail us at elite@halabahrain.bh.</p>
    </div>
    <br>

@endsection
