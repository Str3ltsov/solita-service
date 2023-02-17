@component('mail::message')
@if (app()->getLocale() == 'lt')
Sveiki, {{ $name }},

Užsakymo ID: {{ $orderId }} būsena pakeista iš {{ $prevOrderStatus }} į {{ $newOrderStatus }}.

Pagarbiai, {{ config('app.name') }}
@elseif(app()->getLocale() == 'ru')
Здравствуйте, {{ $name }},

Заказа ID: {{ $orderId }} статус изменился с {{ $prevOrderStatus }} на {{ $newOrderStatus }}.

С уважением, {{ config('app.name') }}
@else
Hello, {{ $name }},

Order ID: {{ $orderId }} status changed from {{ $prevOrderStatus }} to {{ $newOrderStatus }}.

Sincerely, {{ config('app.name') }}
@endif
@endcomponent
