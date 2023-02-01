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
            <a href="{{ url("/{$prefix}/vieworder/{$order->id}/review") }}">
                {{ $order->id }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('buttons.leaveOrderReview') }}
            </span>
        </div>
    </div>
    <div class="container">
{{--        @include('messages')--}}
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
                    <h3 style="font-family: 'Times New Roman', sans-serif">
                        {{__('buttons.leaveOrderReview')}}
                    </h3>
                    <div>
                        <a href="{{ url()->previous() }}" class="category-return-button px-4">
                            <i class="fa-solid fa-arrow-left fs-6 me-2"></i>
                            {{ __('buttons.back') }}
                        </a>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3 pb-4">
                    @include('user_views.order_review.form')
                </div>
            </div>
        </div>
    </div>
@endsection

