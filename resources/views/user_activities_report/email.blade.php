@component('mail::message')

    Hello, {{ $email }},<br>
    Your requested user activities report has been sent to you.

    @component('mail::table')
        @include('user_activities_report.report')
    @endcomponent

    From, {{ config('app.name') }}

@endcomponent