@extends('emails.layout')
@section('content')

<style>
table {border-collapse: collapse;}
th, td {border: 1px solid grey;}
</style>

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
    <table>
    <tbody>
        <tr>
            <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Flight Status:</td>
            <td>@if($data[1])Arrival @else Departure @endif</td>
        </tr>
        <tr>
            <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Arriving From:</td>
            <td>{{$data[9]['name']}}</td>
        </tr>
        <tr>
            <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Date:</td>
            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d',$data[2])->format('d F, Y') }}</td>
        </tr>
        <tr>
            <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Time:</td>
            <td>{{$data[3]}}</td>
        </tr>
        <tr>
            <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Flight Number:</td>
            <td>{{$data[4]}}</td>
        </tr>
        <tr>
            <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Adults:</td>
            <td>{{$data[5]}}</td>
        </tr>
        <tr>
            <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Children:</td>
            <td>{{$data[6]}}</td>
        </tr>
        <tr>
            <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Infants:</td>
            <td>{{$data[7]}}</td>
        </tr>
        @foreach( $data[8] as $key => $value)
            <tr>
                <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Passenger {{$key+1}}:</td>
                <td></td>
            </tr>
            <tr>
                <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Title:</td>
                <td>{{$value['title']}}</td>
            </tr>
            <tr>
                <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">First Name:</td>
                <td>{{$value['first_name']}}</td>
            </tr>
            <tr>
                <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Last Name:</td>
                <td>{{$value['last_name']}}</td>
            </tr>
            <tr>
                <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Date of Birth:</td>
                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d',$value['birth_date'])->format('d F, Y') }}</td>
            </tr>
            <tr>
                <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Nationality:</td>
                <td>{{$value['nationality_id']['name']}}</td>
            </tr>
            <tr>
                <td style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Class:</td>
                <td>{{$value['flight_class']}}</td>
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
