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
    <table>
    <tbody>
        <tr>
            <td>Flight Status:</td>
            <td>@if($data[1])Arrival @else Departure @endif</td>
        </tr>
        <tr>
            <td>Arriving From:</td>
            <td>{{$data[9]['name']}}</td>
        </tr>
        <tr>
            <td>Date:</td>
            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d',$data[2])->format('d F, Y') }}</td>
        </tr>
        <tr>
            <td>Time:</td>
            <td>{{$data[3]}}</td>
        </tr>
        <tr>
            <td>Flight Number:</td>
            <td>{{$data[4]}}</td>
        </tr>
        <tr>
            <td>Adults:</td>
            <td>{{$data[5]}}</td>
        </tr>
        <tr>
            <td>Children:</td>
            <td>{{$data[6]}}</td>
        </tr>
        <tr>
            <td>Infants:</td>
            <td>{{$data[7]}}</td>
        </tr>
        @foreach( $data[8] as $key => $value)
            <tr>
                <td>Passenger {{$key+1}}:</td>
                <td></td>
            </tr>
            <tr>
                <td>Title:</td>
                <td>{{$value['title']}}</td>
            </tr>
            <tr>
                <td>First Name:</td>
                <td>{{$value['first_name']}}</td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td>{{$value['last_name']}}</td>
            </tr>
            <tr>
                <td>Date of Birth:</td>
                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d',$value['birth_date'])->format('d F, Y') }}</td>
            </tr>
            <tr>
                <td>Nationality:</td>
                <td>{{$value['nationality_id']['name']}}</td>
            </tr>
            <tr>
                <td>Class:</td>
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
