@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/specialist/orders") }}">
                {{ __('menu.orders') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $order->id ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="row mb-4">
                    <div class="d-flex flex-column">
                        <h3 class="mt-3 mb-2">
                            {{__('names.order')}}: {{ $order->id }}
                        </h3>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3 mb-4 border-around">
                    <h5 class="mt-2 mb-3">{{ __('names.order') }}</h5>
                    <div class="d-flex flex-column flex-lg-row justify-content-between flex-wrap gap-lg-3">
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.title') }}:</span>
                                <span class="text-black">{{ $order->name }}</span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                {{__('names.customer')}}:
                                <a href="{{ route('userReviews', [$order->user_id]) }}" class="fw-bold d-flex gap-1">
                                    {{ __($order->user->name) }}
                                    <div class="d-flex align-items-center">
                                        <span>{{ round(number_format($reviewAverageRating['user'], 2), 1) ?? 0 }}</span>
                                        <span>/</span>
                                        <span>5</span>
                                        @if ($reviewAverageRating > 0)
                                            <i class="fa-solid fa-star text-warning ms-1"></i>
                                        @else
                                            <i class="fa-regular fa-star text-warning ms-1"></i>
                                        @endif
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                {{__('table.employee')}}:
                                <a href="{{ route('userReviews', [$order->employee_id]) }}"
                                   class="fw-bold d-flex gap-1">
                                    {{ __($order->employee->name) }}
                                    <div class="d-flex align-items-center">
                                        <span>{{ round(number_format($reviewAverageRating['employee'], 2), 1) ?? 0 }}</span>
                                        <span>/</span>
                                        <span>5</span>
                                        @if ($reviewAverageRating > 0)
                                            <i class="fa-solid fa-star text-warning ms-1"></i>
                                        @else
                                            <i class="fa-regular fa-star text-warning ms-1"></i>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.status') }}:</span>
                                <span class="text-black">
                                    @foreach(\App\Models\Order::getOrderStatuses() as $key => $orderStatus)
                                        @if ($orderUser->order->status->id === $key)
                                            {{ $orderStatus[$key] }}
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.budget') }}:</span>
                                <span class="text-black">€{{ number_format(($order->budget * $order->total_hours), 2) }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.totalHours') }}:</span>
                                <span class="text-black">{{ $order->total_hours.' '.__('table.hour')}}</span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.completeHours') }}:</span>
                                <span class="text-black">
                                    {{ $order->complete_hours ? $order->complete_hours.' '.__('table.hour') : '-' }}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.startDate') }}:</span>
                                <span class="text-black">{{ $order->start_date ? $order->start_date->format('Y-m-d') : '-' }}</span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.endDate') }}:</span>
                                <span class="text-black">{{ $order->end_date ? $order->end_date->format('Y-m-d') : '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-4">
                    <div class="d-flex flex-column flex-md-row gap-md-2 gap-0 text-muted my-2">
                        <span>{{ __('table.description') }}:</span>
                        <span class="text-black">{{ $order->description ?? '-' }}</span>
                    </div>
                    <hr class="mt-4">
                    <div class="d-flex flex-column flex-xl-row justify-content-between mb-3">
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.yourTotalHours') }}:</span>
                                <span class="text-black">{{ $orderUser->hours.' '.__('table.hour') }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.yourCompleteHours') }}:</span>
                                <span class="text-black">
                                    {{ $orderUser->complete_hours ? $orderUser->complete_hours.' '.__('table.hour') : '-' }}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.yourHoursLeft') }}:</span>
                                <span class="text-black">{{ $orderUser->hours - $orderUser->complete_hours.' '.__('table.hour') }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.completePercentage') }}:</span>
                                <div class="complete-percentage-wrapper">
                                    <span>{{ number_format($orderUser->complete_percentage, 2).' %' }}</span>
                                    <div style="width: {{ $orderUser->complete_percentage }}%; height: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($orderUser->complete_percentage !== 100.0)
                    <div class="row bg-white mx-0 p-3 pb-4 mb-4 border-around">
                        <h5 class="mt-2 mb-3">{{ __('names.addHours') }}</h5>
                        @include('specialist_views.orders.add_hours_form')
                    </div>
                @endif
                <div class="row bg-white mx-md-0 p-3 pb-4 mb-4 border-around">
                    <h5 class="my-2">{{ __('names.files') }}</h5>
                    <div class="col-md-6 col-12">
                        @include('user_views.orders.upload_document')
                    </div>
                    <div class="col-md-6 col-12 d-flex flex-column mt-4 mt-md-0">
                        <div class="p-3 overflow-scroll d-flex flex-column gap-2"
                             style="border: 1px solid lightgray; height: 170px">
                            @forelse($order->files as $orderFile)
                                <a href="{{ route('downloadDocument', [$prefix, $order->id, $orderFile->id]) }}"
                                   class="d-flex flex-wrap align-items-center py-2 px-3 shadow-sm">
                                    @if ($orderFileExtensions[$loop->index] === 'txt' || $orderFileExtensions[$loop->index] === 'text')
                                        <i class="fa-solid fa-file-lines fs-5 me-2"></i>
                                    @elseif ($orderFileExtensions[$loop->index] === 'pdf')
                                        <i class="fa-solid fa-file-pdf fs-5 me-2"></i>
                                    @else
                                        <i class="fa-solid fa-file-word fs-5 me-2"></i>
                                    @endif
                                    <span class="fw-bold">{{ $orderFile->name }}</span>
                                </a>
                            @empty
                                <span class="text-muted">{{ __('names.noFiles') }}</span>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="row bg-white mx-0 p-3 border-around">
                    <h5 class="my-2">{{ __('names.orderHistory') }}</h5>
                    @include('specialist_views.log_table')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .complete-percentage-wrapper {
            border: 1px solid #ccc;
            background: #fff;
            transition: all 500ms ease;
            position: relative;
            min-width: 150px;
        }

        .complete-percentage-wrapper span {
            position: absolute;
            top: 0;
            left: calc(100% / 2.9);
        }

        .complete-percentage-wrapper div {
            height: 25px;
        }
    </style>
@endpush
