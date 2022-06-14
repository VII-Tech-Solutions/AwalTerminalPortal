@extends('emails.layout')
@section('content')
    <p style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif;">Hi Awal Team,</p>
    <p style="font-size: 15px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif;">A new submission sent via the contact form, please review it from <a href="{{$link}}" target="_blank">here</a></p>
@endsection
