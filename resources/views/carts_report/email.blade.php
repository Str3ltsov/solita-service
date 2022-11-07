@component('mail::message')

    Hello, {{ $email }},<br>
    Your requested carts report has been sent to you.

    @component('mail::table')
        @include('carts_report.report')
    @endcomponent

    From, {{ config('app.name') }}

@endcomponent