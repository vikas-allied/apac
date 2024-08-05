
@component('mail::message')
{{--@component('vendor.mail.text.message')--}}


    {!! $body !!}

    Regards,
    {{ config('app.name') }}
@endcomponent

