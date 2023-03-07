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
    <table style="border-collapse: collapse; border: 1px solid gray;">
    <tbody>
        <tr>
            <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;">Flight Status:</td>
            <td style="padding: 2px;">@if($data[1])Arrival @else Departure @endif</td>
        </tr>
        <tr>
            <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Arriving From:</td>
            <td style="padding: 2px;border-top: 1px solid gray;">{{$data[9]['name']}}</td>
        </tr>
        <tr>
            <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Date:</td>
            <td style="padding: 2px;border-top: 1px solid gray;">{{ Carbon\Carbon::createFromFormat('Y-m-d',$data[2])->format('d F, Y') }}</td>
        </tr>
        <tr>
            <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Time:</td>
            <td style="padding: 2px;border-top: 1px solid gray;">{{$data[3]}}</td>
        </tr>
        <tr>
            <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Flight Number:</td>
            <td style="padding: 2px;border-top: 1px solid gray;">{{$data[4]}}</td>
        </tr>
        <tr>
            <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Adults:</td>
            <td style="padding: 2px;border-top: 1px solid gray;">{{$data[5]}}</td>
        </tr>
        <tr>
            <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Children:</td>
            <td style="padding: 2px;border-top: 1px solid gray;">{{$data[6]}}</td>
        </tr>
        <tr>
            <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Infants:</td>
            <td style="padding: 2px;border-top: 1px solid gray;">{{$data[7]}}</td>
        </tr>
        @foreach( $data[8] as $key => $value)
            <tr>
                <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Passenger {{$key+1}}:</td>
                <td style="padding: 2px;border-top: 1px solid gray;"></td>
            </tr>
            <tr>
                <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Title:</td>
                <td style="padding: 2px;border-top: 1px solid gray;">{{$value['title']}}</td>
            </tr>
            <tr>
                <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">First Name:</td>
                <td style="padding: 2px;border-top: 1px solid gray;">{{$value['first_name']}}</td>
            </tr>
            <tr>
                <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Last Name:</td>
                <td style="padding: 2px;border-top: 1px solid gray;">{{$value['last_name']}}</td>
            </tr>
            <tr>
                <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Date of Birth:</td>
                <td style="padding: 2px;border-top: 1px solid gray;">{{ Carbon\Carbon::createFromFormat('Y-m-d',$value['birth_date'])->format('d F, Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Nationality:</td>
                <td style="padding: 2px;border-top: 1px solid gray;">{{$value['nationality_id']['name']}}</td>
            </tr>
            <tr>
                <td style="padding: 2px; font-weight: bold; border-right: 1px solid gray;border-top: 1px solid gray;">Class:</td>
                <td style="padding: 2px;border-top: 1px solid gray;">{{$value['flight_class']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>


    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">The total amount you are required to pay is BHD{{$data[0]}}.</p>
    </div>
    <br>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">If you require any further assistance, please contact the Bookings Team on Tel: +973 17139831 or Mobile: +973 39471116 or mail us at elite@halabahrain.bh.</p>
    </div>
    <br>

@endsection
