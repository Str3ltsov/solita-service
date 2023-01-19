@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            @if (isset($product))
                <i class="fa-solid fa-angle-right"></i>
                <a href="{{ url("/viewproduct/$product->id") }}">
                    {{ $product->name }}
                </a>
            @endif
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.createOrder') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3 class="mt-3 mb-4" style="font-family: 'Times New Roman', sans-serif">
                        {{ __('names.createOrder') }}
                    </h3>
                    <a href="{{ url()->previous() }}" class="btn orders-returns-primary-button px-4">
                        <i class="fa-solid fa-angle-left me-1 fs-6"></i>
                        {{ __('buttons.back') }}
                    </a>
                </div>
                @include('user_views.create_order.form')
            </div>
        </div>
    </div>
@endsection
