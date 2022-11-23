@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/employee/orders") }}">
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
                    <h3 class="mt-3" style="font-family: 'Times New Roman', sans-serif">
                        {{ __('names.order') }}: {{ $order->order_id }}
                    </h3>
                    <span class="text-muted">
                        {{__('table.user')}}: {{ __($order->user->name) }}
                    </span>
                </div>
                <div class="row bg-white mx-0 p-3 pb-4 mb-4">
                    <h5 class="mt-2 mb-3">{{ __('names.editOrder') }}</h5>
                    @include('employee_views.orders.update_form')
                </div>
                <div class="row bg-white mx-0 p-3 mb-4">
                    <h5 class="my-2">{{ __('names.products') }}</h5>
                    <div class="table table-responsive">
                        @include('employee_views.orders.tables.order_item_table')
                    </div>
                </div>
                <div class="row bg-white mx-0 p-3">
                    <h5 class="my-2">{{ __('names.orderHistory') }}</h5>
                    @include('employee_views.orders.tables.order_log_table')
                </div>
            </div>
        </div>
    </div>
@endsection
