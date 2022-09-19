@component('mail::message')
    Hi {{ $data['name'] }},

    Your support ticket have been successfully created, Admin would process the ticket and contact you asp.

    Thanks,
    {{ config('app.name') }}
@endcomponent
