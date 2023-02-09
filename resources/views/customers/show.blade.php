@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url('/admin/customers') }}">
                {{ __('names.customers') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/admin/customers/$customer->id") }}">
                {{ $customer->id }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.customerDetails') }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12 px-sm-0">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mt-3 mb-4">
                    <h3 class="mb-4 mb-md-0" style="font-family: 'Times New Roman', sans-serif">
                        {{ __('names.customerDetails') }}
                    </h3>
                    <div class="d-flex flex-column flex-md-row gap-3">
                        @if ($customer->type == '2' && count($skills) > 0)
                            <a href="{{ route('adminAddSkill', $customer->id) }}"
                               class='btn btn-primary orders-returns-primary-button'>
                                <i class="fa-solid fa-plus fs-6 me-2"></i>
                                {{ __('buttons.addSkill') }}
                            </a>
                        @endif
                        <a href="{{ route('customers.index') }}"
                           class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-arrow-left fs-6 me-2"></i>
                            {{ __('buttons.back') }}
                        </a>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    @include('customers.show_fields')
                </div>
                @if ($customer->type == '2')
                    <div class="row bg-white mx-md-0 p-3 mt-4">
                        <h5 class="my-3">{{ __('names.skills') }}</h5>
                        <div class="table table-responsive">
                            @include('customers.tables.skill_table')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
