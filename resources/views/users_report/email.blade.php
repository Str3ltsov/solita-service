@component('mail::message')
@if (app()->getLocale() == 'lt')

@component('mail::table')
    |Vartotojo ID |Vardas   |El.paštas   |Telefono numeris |Gatvė  |Namas/Butas |Pašto kodas  |Vaidmuo  |Būsena   |Sukūrimo data |
    |:----------- |:------- |:---------- |:--------------- |:----- |:---------- |:----------- |:--------|:------- |:------------:|
    @foreach($users as $user)
        | {{ $user->id }} | {{ $user->name }} | {{ $user->email }} | {{ $user->phone_number }} | {{ $user->street }} | €{{ $user->house_flat }} | {{ $user->postal_code }} | {{ $user->role->name }} | {{ $user->status->name }} | {{ $user->created_at->format('Y-m-d') }} |
    @endforeach
@endcomponent

@elseif(app()->getLocale() == 'ru')

@component('mail::table')
    |ID пользователя |Имя   |Электронная почта |Номер телефона |Улица   |Дом/квартира |Почтовый индекс |Роль  |Статус  |Дата создания |
    |:-------------- |:---- |:---------------- |:------------- |:------ |:----------- |:-------------- |:---- |:------ |:------------:|
    @foreach($users as $user)
        | {{ $user->id }} | {{ $user->name }} | {{ $user->email }} | {{ $user->phone_number }} | {{ $user->street }} | €{{ $user->house_flat }} | {{ $user->postal_code }} | {{ $user->role->name }} | {{ $user->status->name }} | {{ $user->created_at->format('Y-m-d') }} |
    @endforeach
@endcomponent

@else

@component('mail::table')
    |User ID     |Name     |Email      |Phone Number  |Street    |House/Flat  |Postal Code |Role    |Status    |Created Date |
    |:---------- |:------- |:--------- |:------------ |:-------- |:---------- |:---------- |:------ |:-------- |:-----------:|
    @foreach($users as $user)
        | {{ $user->id }} | {{ $user->name }} | {{ $user->email }} | {{ $user->phone_number }} | {{ $user->street }} | €{{ $user->house_flat }} | {{ $user->postal_code }} | {{ $user->role->name }} | {{ $user->status->name }} | {{ $user->created_at->format('Y-m-d') }} |
    @endforeach
@endcomponent

@endif
@endcomponent
