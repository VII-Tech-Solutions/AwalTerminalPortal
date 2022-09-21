@extends('emails.layout')
@section('content')
    <div style="display: flex">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Hi there,</p>

    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41"> A new General Aviation request has been submitted.</p>
    </div>

    <div style="padding-bottom: 20px">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41"> Follow the link below to view the details:</p>
    </div>

    <div>
        <a style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41" href="{{env('APP_URL')}}/admin/general-aviation-services/">{{env('APP_URL')}}/admin/general-aviation-services</a>
    </div>
@endsection
