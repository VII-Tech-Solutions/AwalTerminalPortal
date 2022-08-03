@extends('emails.layout')
@section('content')

    <div style="display: flex">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41">Hi there,</p>
        @endif
    </div>
    <div>
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41"> A new Elite Service booking has been submitted.</p>
    </div>

    <div style="padding-bottom: 20px">
        <p style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41"> Follow the link below to view the details:</p>
    </div>

    <div>
        <a style="font-size: 16px; line-height: 27px;font-family: 'Source Sans Pro', sans-serif; color: #011e41" href="https://awal.viitech.net/admin/elite-services/">https://awal.viitech.net/admin/elite-services</a>
    </div>
@endsection
