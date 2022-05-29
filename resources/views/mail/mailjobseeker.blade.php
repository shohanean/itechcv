@component('mail::message')
# Message from {{ config('app.name') }}

Please read carefully!

@component('mail::panel')
{{ $message }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
