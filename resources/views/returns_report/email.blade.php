@component('mail::message')

    Hello, {{ $email }},<br>
    Your requested returns report has been sent to you.

    @component('mail::table')
        @include('returns_report.report')
    @endcomponent

    From, {{ config('app.name') }}

@endcomponent