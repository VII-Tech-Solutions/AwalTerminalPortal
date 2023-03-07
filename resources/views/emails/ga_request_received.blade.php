@extends('emails.layout')
@section('content')
    <div style="display: flex">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Hi
            &nbsp;</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #4e89e8">{{$to_name}}
        @if($data[0])
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">&nbsp;
            or &nbsp;</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #4e89e8">{{$data[0]}}</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">,</p>
        @endif
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

    <div style="margin:2px;">
        <table style="border-collapse: collapse; border: 1px solid #d3d3d3;">
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Aircraft Type</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[1]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Registration</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[2]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">MTOW (KG)</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[3]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Lead Passenger Name</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[4]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Purpose of Landing</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[5]}}</td>
            </tr>
        </table>
    </div>

    <div style="margin:2px;">
        <table style="border-collapse: collapse; border: 1px solid #d3d3d3;">
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Arrival:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;"></td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Call Sign:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[6]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">From Airport:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[7]['name']}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">ETA (UTC Time):</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[8]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Arrival Date:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{ Carbon\Carbon::createFromFormat('Y-m-d',$data[9])->format('d F, Y') }}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Nature of Flight:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[10]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Passenger Count:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[11]}}</td>
            </tr>
        </table>
    </div>

    <div style="margin:2px;">
        <table style="border-collapse: collapse; border: 1px solid #d3d3d3;">
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Departure:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;"></td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Call Sign:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[12]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">To Airport:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[13]['name']}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">ETD (UTC Time):</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[14]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Departure Date:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{ Carbon\Carbon::createFromFormat('Y-m-d',$data[15])->format('d F, Y') }}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Nature of Flight:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[16]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Passenger Count:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[17]}}</td>
            </tr>
        </table>
    </div>

    <div style="margin:2px;">
        <table style="border-collapse: collapse; border: 1px solid #d3d3d3;">
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Operator:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;"></td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Full Name:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[29]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Country:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[18]['name']}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Telephone Number:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[19]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Email Address:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$to_email}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Address:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[20]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Billing Address:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[21]}}</td>
            </tr>
        </table>
    </div>


@if( $data[22])

    <div style="margin:2px;">
        <table style="border-collapse: collapse; border: 1px solid #d3d3d3;">
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Agent:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;"></td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Full Name:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[0]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Country:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[23]['name']}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Telephone Number:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[25]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Email Address:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[24]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Address:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[26]}}</td>
            </tr>
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">Billing Address:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">{{$data[27]}}</td>
            </tr>
        </table>
    </div>

@endif

@if($data[28])

    <div style="margin:2px;">
        <table style="border-collapse: collapse; border: 1px solid #d3d3d3;">
            <tr>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px; font-weight: bold; border-right: 1px solid #d3d3d3;">List of Services:</td>
                <td style="font-family: 'Source Sans Pro', sans-serif;padding: 8px;">
            @foreach($data[28] as $key => $value)
               @if($key != 0)
                ,
                @endif
            {{$value['name']}}
            @endforeach
        </td>
            </tr>
        </table>
    </div>

@endif
    <br>

    <br>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">If you require any further assistance, please contact the Bookings Team on Tel: +973 17139831 or Mobile: +973 39471116 or mail us at elite@halabahrain.bh.</p>
    </div>
    <br>
@endsection
