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
            <a href="{{ url("/employee/orders/{$order->id}") }}">
                {{ $order->id }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.addSpecialists') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
                    <h3 class="m-0" style="font-family: 'Times New Roman', sans-serif">
                        {{ __('names.addSpecialists') }}
                    </h3>
                    <div>
                        <a href="{{ url()->previous() }}" class="category-return-button px-4">
                            {{ __('buttons.back') }}
                        </a>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-4 gap-4">
                    @include('employee_views.orders.specialists')
                        {!! Form::open(['route' => ['addOrderSpecialistSave', $order->id], 'method' => 'post', 'class' => 'd-flex justify-content-center mt-4 mb-1']) !!}
                            <input type="text" name="specialistsIds" id="specialistsIds" class="d-none">
                            <input type="text" name="specialistsHours" id="specialistsHours" class="d-none">
                            <button type="submit" class="category-return-button px-4 col-xl-3 col-lg-4 col-md-5 col-12">
                                {{ __('buttons.addNew') }}
                            </button>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
