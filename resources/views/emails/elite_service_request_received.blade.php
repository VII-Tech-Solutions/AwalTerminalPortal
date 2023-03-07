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
    <table style="border-collapse: collapse; border: 1px solid #d3d3d3;">
    <tbody>
        <tr>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Flight Status:</td>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">@if($data[1])Arrival @else Departure @endif</td>
        </tr>
        <tr>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Arriving From:</td>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{$data[9]['name']}}</td>
        </tr>
        <tr>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Date:</td>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{ Carbon\Carbon::createFromFormat('Y-m-d',$data[2])->format('d F, Y') }}</td>
        </tr>
        <tr>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Time:</td>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{$data[3]}}</td>
        </tr>
        <tr>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Flight Number:</td>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{$data[4]}}</td>
        </tr>
        <tr>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Adults:</td>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{$data[5]}}</td>
        </tr>
        <tr>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Children:</td>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{$data[6]}}</td>
        </tr>
        <tr>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Infants:</td>
            <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{$data[7]}}</td>
        </tr>
        @foreach( $data[8] as $key => $value)
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Passenger {{$key+1}}:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;"></td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Title:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{$value['title']}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">First Name:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{$value['first_name']}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Last Name:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{$value['last_name']}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Date of Birth:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{ Carbon\Carbon::createFromFormat('Y-m-d',$value['birth_date'])->format('d F, Y') }}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Nationality:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;border-top: 1px solid #d3d3d3;">{{$value['nationality_id']['name']}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;border-top: 1px solid #d3d3d3;">Class:</td>
                <td style="padding: 8px;border-top: 1px solid #d3d3d3;font-family: 'Source Sans Pro', sans-serif;">{{$value['flight_class']}}</td>
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
