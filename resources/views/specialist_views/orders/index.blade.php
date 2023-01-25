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
                        @include('specialist_views.orders.tables.order_table')
                    </div>
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
            min-width: 100px;
        }

        .complete-percentage-wrapper span {
            position: absolute;
            top: -2px;
            left: calc(100% / 3.2);
            color: #222;
            font-weight: 600;
        }

        .complete-percentage-wrapper div {
            height: 25px;
            background: #fcb200;
        }
    </style>
@endpush
