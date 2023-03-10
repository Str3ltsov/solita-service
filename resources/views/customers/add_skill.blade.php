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
                {{ __('names.customerAddSkill') }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mt-3 mb-4">
                    <h3>
                        {{ __('names.customerAddSkill') }}
                    </h3>
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <a href="{{ route('customers.index') }}"
                           class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-arrow-left fs-6 me-2"></i>
                            {{ __('buttons.back') }}
                        </a>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3 border-around">
                    {!! Form::model($customer, ['route' => ['adminSaveAddedSkill', $customer->id], 'method' => 'post', 'class' => 'auth-form-container px-0']) !!}
                        <div class="row">
                            <input type="hidden" name="user_id" value="{{ $customer->id }}">
                            <div class="form-group col-md-6 col-12 mb-2">
                                {!! Form::label('skill_id', __('names.skills').':') !!}
                                {!! Form::select('skill_id', $skills, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
                            </div>
                            <div class="form-group col-md-6 col-12 mb-2">
                                {!! Form::label('experience', __('names.experience').' ('.__('names.years').')') !!}
                                {!! Form::select('experience', $experiences, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="col-12 col-md-4 category-return-button px-4" data-loading-text="Loading...">
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
