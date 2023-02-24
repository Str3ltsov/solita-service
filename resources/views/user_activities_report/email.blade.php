@component('mail::message')
@if (app()->getLocale() == 'lt')

@component('mail::table')
    |Veiklos ID  |Vardas   |El.paštas   |Vaidmuo   |Veikla     |Sukūrimo data |
    |:---------- |:------- |:---------- |:-------- |:--------- |:------------:|
    @foreach($userActivities as $userActivity)
        | {{ $userActivity->id }} | {{ $userActivity->user->name }} | {{ $userActivity->user->email }} | {{ $userActivity->user->role->name }} | {{ $userActivity->activity }} | {{ $userActivity->created_at->format('Y-m-d') }} |
    @endforeach
@endcomponent

@elseif(app()->getLocale() == 'ru')

@component('mail::table')
    |ID действия |Имя      |Электронная почта |Роль  |Действие  |Дата создания |
    |:---------- |:------- |:---------------- |:---- |:-------- |:------------:|
    @foreach($userActivities as $userActivity)
        | {{ $userActivity->id }} | {{ $userActivity->user->name }} | {{ $userActivity->user->email }} | {{ $userActivity->user->role->name }} | {{ $userActivity->activity }} | {{ $userActivity->created_at->format('Y-m-d') }} |
    @endforeach
@endcomponent

@else

@component('mail::table')
    |Activity ID  |Name     |Email      |Role     |Activity    |Created Date |
    |:----------  |:------- |:--------- |:------- |:---------- |:-----------:|
    @foreach($userActivities as $userActivity)
        | {{ $userActivity->id }} | {{ $userActivity->user->name }} | {{ $userActivity->user->email }} | {{ $userActivity->user->role->name }} | {{ $userActivity->activity }} | {{ $userActivity->created_at->format('Y-m-d') }} |
    @endforeach
@endcomponent

@endif
@endcomponent
