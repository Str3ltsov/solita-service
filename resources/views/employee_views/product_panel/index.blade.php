@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container px-sm-0">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.productPanel') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container px-sm-0">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mt-3 mb-4">
                    <h3 class="mb-4 mb-md-0" style="font-family: 'Times New Roman', sans-serif">
                        {{ __('menu.products') }}
                    </h3>
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <a href="{{ route('product_panel.create') }}"
                           class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-plus fs-6 me-2"></i>
                            {{ __('buttons.add') }}
                        </a>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    <div class="table table-responsive">
                        @include('employee_views.product_panel.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
