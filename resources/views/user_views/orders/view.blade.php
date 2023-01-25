@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/{$prefix}/rootorders") }}">
                {{ __('menu.orders') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $order->id }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-lg-12 d-flex flex-column gap-4">
                <div class="row">
                    <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between">
                        <div class="d-flex flex-column mb-2 mb-md-0">
                            <h3 class="mt-3 mb-2" style="font-family: 'Times New Roman', sans-serif">
                                {{__('names.order')}}: {{ $order->id }}
                            </h3>
                        </div>
                        <div class="d-flex flex-column flex-md-row gap-3 mt-2 mt-md-0">
                            @if ($order->status_id === 3)
                                {!! Form::model($order, ['route' => ['approveOrder', [$prefix, $order->id]], 'method' => 'patch']) !!}
                                    <button type="submit"
                                       class='btn btn-primary orders-returns-primary-button'>
                                        <i class="fa-solid fa-square-check me-2 fs-6"></i>
                                        {{ __('buttons.approveOrder') }}
                                    </button>
                                {!! Form::close() !!}
                            @endif
                            @if($order->status_id < 6)
{{--                                <div class="btn-group" style="float: right">--}}
{{--                                    <a href="{{ route('returnorder', [$prefix, $order->id]) }}"--}}
{{--                                       class='btn btn-primary orders-returns-primary-button'>--}}
{{--                                        <i class="far fa-arrow-alt-circle-right me-1 fs-6"></i>--}}
{{--                                        {{ __('buttons.return') }}--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                <div class="btn-group" style="float: right">
                                    <a href="{{ route('cancelnorder', [$prefix, $order->id]) }}"
                                       class='btn btn-primary orders-returns-primary-button'>
                                        <i class="far fa-trash-alt me-1 fs-6"></i>
                                        {{ __('buttons.cancel') }}
                                    </a>
                                </div>
                                @if($order->status->name == 'Completed')
                                    <div class="btn-group" style="float: right">
                                        <a href="{{ route('download_invoice', [$prefix, $order->id]) }}"
                                           class='btn btn-primary orders-returns-primary-button'>
                                            <i class="fa-solid fa-file-invoice me-1 fs-6"></i>
                                            {{__('buttons.invoice')}}
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    <h5 class="mt-2 mb-3">{{ __('names.order') }}</h5>
                    <div class="d-flex flex-column flex-lg-row justify-content-between">
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.title') }}:</span>
                                <span class="text-black">{{ $order->name }}</span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                {{__('table.employee')}}:
                                <a href="{{ route('userReviews', [$order->employee_id]) }}" class="fw-bold d-flex gap-1">
                                    {{ __($order->employee->name) }}
                                    <div class="d-flex align-items-center">
                                        <span>{{ round(number_format($reviewAverageRating['employee'], 2), 1) }}</span>
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
                                <span class="text-black">{{ $order->status->name }}</span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.budget') }}:</span>
                                <span class="text-black">€{{ number_format($order->budget, 2) }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.totalHours') }}:</span>
                                <span class="text-black">{{ $order->total_hours.' '.__('table.hour') }}</span>
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
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    <h5 class="my-2">{{ __('names.specialists') }}</h5>
                    <div class="table table-responsive">
                        @include('user_views.orders.tables.order_specialists_table')
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    <h5 class="my-2">{{ __('names.orderHistory') }}</h5>
                    @include('orders.history_table')
                </div>
            </div>
        </div>
    </div>
@endsection

