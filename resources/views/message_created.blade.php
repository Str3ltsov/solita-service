@component('mail::message')
@if (app()->getLocale() == 'lt')
Sveiki,

Iš {{ $senderName }} jums buvo išsiųstas naujas pranešimas dėl užsakymo: {{ $orderName }}

Pagarbiai, {{ config('app.name') }}
@elseif(app()->getLocale() == 'ru')
Здравствуйте,

Вам отправлено новое сообщение от {{ $senderName }} относительно заказа: {{ $orderName }}

С уважением, {{ config('app.name') }}
@else
Hello,

A new message has been sent to you from {{ $senderName }}, regarding order: {{ $orderName }}

Sincerely, {{ config('app.name') }}
@endif
@endcomponent
