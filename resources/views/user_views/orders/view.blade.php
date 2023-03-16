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
                            <h3 class="mt-3 mb-2">
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
                                <div class="btn-group" style="float: right">
                                    <a href="{{ route('cancelnorder', [$prefix, $order->id]) }}"
                                       class='btn btn-primary orders-returns-primary-button'>
                                        <i class="far fa-trash-alt me-1 fs-6"></i>
                                        {{ __('buttons.cancel') }}
                                    </a>
                                </div>
                            @endif
                                @if ($order->status->name === 'Completed' && count($order->questionAnswers) < 1)
                                    <div class="btn-group" style="float: right">
                                        <a href="{{ route('getOrderReview', [$prefix, $order->id]) }}"
                                           class='btn btn-primary orders-returns-primary-button'>
                                            <i class="fa-solid fa-star me-1 fs-6"></i>
                                            {{__('buttons.leaveOrderReview')}}
                                        </a>
                                    </div>
                                @endif
                        </div>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3 border-around">
                    <h5 class="mt-2 mb-3">{{ __('names.order') }}</h5>
                    <div class="d-flex flex-column flex-lg-row justify-content-between">
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.title') }}:</span>
                                <span class="text-black">{{ $order->name }}</span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                {{__('table.employee')}}:
                                <a href="{{ route('userReviews', [$order->employee_id]) }}"
                                   class="fw-bold d-flex gap-1">
                                    {{ __($order->employee->name) }}
                                    <div class="d-flex align-items-center">
                                        <span>{{ round(number_format($order->employee->average_rating, 2), 1) ?? 0 }}</span>
                                        <span>/</span>
                                        <span>5</span>
                                        @if ($order->employee->average_rating > 0)
                                            <i class="fa-solid fa-star text-warning ms-1"></i>
                                        @else
                                            <i class="fa-regular fa-star text-warning ms-1"></i>
                                        @endif
                                    </div>
                                </a>
                            </div>
                            @if ($order->status->name === 'Completed' && count($order->questionAnswers) > 0)
                                <div class="d-flex gap-2 text-muted">
                                    <span>{{ __('names.rating') }}:</span>
                                    <div class="text-black d-flex">
                                        <span>{{ round(number_format($order->questionAnswers[0]->answer, 1), 2) ?? '-' }}</span>
                                        <span>/</span>
                                        <span>5</span>
                                    </div>
                                    <span>
                                        <i class="fa-solid fa-star text-warning"></i>
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.status') }}:</span>
                                <span class="text-black">
                                    @foreach(\App\Models\Order::getOrderStatuses() as $key => $orderStatus)
                                        @if ($order->status->id === $key)
                                            {{ $orderStatus[$key] }}
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.budget') }}:</span>
                                <span class="text-black">€{{ number_format($order->budget, 2) }}</span>
                            </div>
{{--                            @if ($order->status->name === 'Completed')--}}
{{--                                <div class="d-flex gap-2 text-muted">--}}
{{--                                    <span>{{ __('names.total') }}:</span>--}}
{{--                                    <span class="text-black">--}}
{{--                                    <span class="text-black">€{{ number_format($order->sum, 2) ?? '-' }}</span>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            @endif--}}
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
                                <span
                                    class="text-black">{{ $order->start_date ? $order->start_date->format('Y-m-d') : '-' }}</span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.endDate') }}:</span>
                                <span
                                    class="text-black">{{ $order->end_date ? $order->end_date->format('Y-m-d') : '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-4">
                    <div class="d-flex flex-column flex-md-row gap-md-2 gap-0 text-muted my-2">
                        <span>{{ __('table.description') }}:</span>
                        <span class="text-black">{{ $order->description ?? '-' }}</span>
                    </div>
                </div>
                @if ($order->status_id > 5)
                    <div class="row bg-white mx-md-0 p-3 pb-4 border-around">
                        <h5 class="my-2">{{ __('names.files') }}</h5>
                        <div class="col-md-6 col-12">
                            @include('user_views.orders.order_files')
                        </div>
                        <div class="col-md-6 col-12 d-flex flex-column mt-4 mt-md-0">
                            <div class="h-100 py-2 px-3 overflow-scroll d-flex flex-column gap-2" style="border: 1px solid lightgray">
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
                @endif
                <div class="row bg-white mx-md-0 p-3 border-around">
                    <h5 class="my-2">{{ __('names.specialists') }}</h5>
                    <div class="table table-responsive">
                        @include('user_views.orders.tables.order_specialists_table')
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3 border-around">
                    <h5 class="my-2">{{ __('names.orderHistory') }}</h5>
                    @include('orders.history_table')
                </div>
            </div>
        </div>
    </div>
@endsection

