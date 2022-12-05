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
                {{ $order->order_id ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="row mb-4">
                    <div class="d-flex flex-column">
                        <h3 class="mt-3 mb-2" style="font-family: 'Times New Roman', sans-serif">
                            {{__('names.order')}}: {{ $order->order_id }}
                        </h3>
                        <div class="d-flex gap-2 text-muted">
                            {{__('table.user')}}:
                            <a href="{{ route('userReviews', [$order->user_id]) }}" class="fw-bold d-flex gap-1">
                                {{ __($order->user->name) }}
                                <div class="d-flex align-items-center">
                                    <span>{{ round(number_format($reviewAverageRating['user'], 2), 1) }}</span>
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
                </div>
                <div class="row bg-white mx-0 p-3 pb-4 mb-4">
                    <h5 class="mt-2 mb-3">{{ __('names.editOrder') }}</h5>
                    @include('specialist_views.orders.update_form')
                </div>
                <div class="row bg-white mx-0 p-3 mb-4">
                    <h5 class="my-2">{{ __('names.products') }}</h5>
                    <div class="table table-responsive">
                        @include('specialist_views.orders.tables.order_item_table')
                    </div>
                </div>
                <div class="row bg-white mx-0 p-3">
                    <h5 class="my-2">{{ __('names.orderHistory') }}</h5>
                    @include('specialist_views.log_table')
                </div>
            </div>
        </div>
    </div>
@endsection
