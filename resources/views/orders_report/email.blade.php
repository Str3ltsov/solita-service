@component('mail::message')

    Hello, {{ $email }},<br>
    Your requested orders report has been sent to you.

    @component('mail::table')
        @include('orders_report.report')
    @endcomponent

    From, {{ config('app.name') }}

@endcomponent