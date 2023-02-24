@component('mail::message')
@if (app()->getLocale() == 'lt')

@component('mail::table')
    |Užsakymo ID  |Klientas   |Darbuotojas |Vardas     |Aprašymas      |Budţetas |Iš viso valandų |Uţbaigtos valandos |Pradţios data |Pabaigos data |
    |:----------- |:--------- |:---------- |:--------- |:------------- |:-------:|:--------------:|:-----------------:|:------------:|:------------:|
    @foreach($orders as $order)
        | {{ $order->id }} | {{ $order->user->name }} | {{ $order->employee->name }} | {{ $order->name }} | {{ $order->description }} | €{{ $order->budget }} | {{ $order->total_hours }} | {{ $order->complete_hours }} | {{ $order->start_date->format('Y-m-d') }} | {{ $order->end_date->format('Y-m-d') }} |
    @endforeach
@endcomponent

@elseif(app()->getLocale() == 'ru')

@component('mail::table')
    |Идентификатор заказа |Клиент     |Сотрудник   |Имя        |Описание    |Бюджет   |Общее количество часов |Комплект часов     |Дата начала   |Дата окончания |
    |:------------------- |:--------- |:---------- |:--------- |:---------- |:-------:|:---------------------:|:-----------------:|:------------:|:-------------:|
    @foreach($orders as $order)
        | {{ $order->id }} | {{ $order->user->name }} | {{ $order->employee->name }} | {{ $order->name }} | {{ $order->description }} | €{{ $order->budget }} | {{ $order->total_hours }} | {{ $order->complete_hours }} | {{ $order->start_date->format('Y-m-d') }} | {{ $order->end_date->format('Y-m-d') }} |
    @endforeach
@endcomponent

@else

@component('mail::table')
    |Order ID     |Client     |Employee  |Name       |Description    |Budget  |Total Hours |Complete Hours |Start Date |End Date  |
    |:----------- |:--------- |:-------- |:--------- |:------------- |:------:|:----------:|:-------------:|:---------:|:--------:|
    @foreach($orders as $order)
        | {{ $order->id }} | {{ $order->user->name }} | {{ $order->employee->name }} | {{ $order->name }} | {{ $order->description }} | €{{ $order->budget }} | {{ $order->total_hours }} | {{ $order->complete_hours }} | {{ $order->start_date->format('Y-m-d') }} | {{ $order->end_date->format('Y-m-d') }} |
    @endforeach
@endcomponent

@endif
@endcomponent
