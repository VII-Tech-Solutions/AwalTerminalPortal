@extends('emails.layout')
@section('content')
    <div style="display: flex">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Hi
            &nbsp;</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #4e89e8">{{$to_name}}</p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">,</p>
    </div>

    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Your booking for Elite Service at Awal Private Terminal has been rejected.</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">The reason provided by management is the following </p>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #FF0000"> {{$rejectionReason}}</p>
    </div>

    <br>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">You can resubmit a request on our website and try again..</p>
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">We appreciate your understanding.</p>
    </div>
    <br>
@endsection
