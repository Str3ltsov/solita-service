@component('mail::message')

    Hello, {{ $email }},<br>
    Your requested users report has been sent to you.

    @component('mail::table')
        @include('users_report.report')
    @endcomponent

    From, {{ config('app.name') }}

@endcomponent