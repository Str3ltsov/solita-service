@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.orders') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <h3 class="mt-3 mb-4" style="font-family: 'Times New Roman', sans-serif">
                        {{ __('menu.orders') }}
                    </h3>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    <div class="table table-responsive">
                        @include('employee_views.orders.tables.order_table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
