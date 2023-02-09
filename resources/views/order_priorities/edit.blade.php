@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url('/admin/orderPriorities') }}">
                {{ __('names.orderPriorities') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.editOrderPriority').': '.$orderPriority->id }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mt-3 mb-4">
                    <h3 class="mb-4 mb-md-0" style="font-family: 'Times New Roman', sans-serif">
                        {{ __('names.editOrderPriority').': '.$orderPriority->id }}
                    </h3>
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <a href="{{ route('orderPriorities.index') }}"
                           class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-arrow-left fs-6 me-2"></i>
                            {{ __('buttons.back') }}
                        </a>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    {!! Form::model($orderPriority, ['route' => ['orderPriorities.update', $orderPriority->id], 'method' => 'patch', 'class' => 'auth-form-container px-0']) !!}
                    <div class="row">
                        @include('order_priorities.fields')
                        <div class="d-flex justify-content-center mt-4 mb-2">
                            <button type="submit" class="col-12 col-md-4 category-return-button" data-loading-text="Loading...">
                                {{ __('buttons.add') }}
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
