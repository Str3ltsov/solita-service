@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.profile') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
    </div>
    <div class="container">
        <div class="mb-4 mt-5" style="font-family: 'Times New Roman', sans-serif">
            <h3>{{__('menu.profile')}}</h3>
        </div>
            <div class="col bg-white py-3 px-4">
                <div id="description" class="tabs tabs-simple tabs-simple-full-width-line tabs-product tabs-dark mb-2">
                    <ul class="nav nav-tabs justify-content-start mb-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active py-2 px-3" href="#profile" data-bs-toggle="tab" aria-selected="true" role="tab">
                                {{ __('menu.userInfo') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link nav-link-reviews py-2 px-3" href="#password" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
                                {{ __('auth.passwordEnter') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-0">
                        <div class="tab-pane px-0 active" id="profile" role="tabpanel">
                            <div class="auth-form">
                                    {!! Form::model($user, ['route' => ['userprofilesave'], 'method' => 'patch', 'class' => 'auth-form-container px-0']) !!}
                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-12">
                                                {!! Form::label('code', __('forms.name') )!!}
                                                {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                {!! Form::label('email', __('forms.email')) !!}
                                                {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                                {!! Form::label('street', __('forms.street')) !!}
                                                {!! Form::text('street', $user->street, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group col-md-3 col-sm-6 mb-2">
                                                {!! Form::label('house_flat', __('forms.house_flat')) !!}
                                                {!! Form::text('house_flat', $user->house_flat, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group col-md-3 col-sm-6 mb-2">
                                                {!! Form::label('post_index', __('forms.post_index')) !!}
                                                {!! Form::text('post_index', $user->post_index, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                                {!! Form::label('city', __('forms.city')) !!}
                                                {!! Form::text('city', $user->city, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12 mb-2">
                                                {!! Form::label('phone_number', __('forms.phone_number')) !!}
                                                {!! Form::text('phone_number', $user->phone_number, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="d-flex justify-content-center mt-4">
                                                <button type="submit" class="col-sm-3 col-md-4 col-sm-12 py-2 auth-button" data-loading-text="Loading...">
                                                    {{ __('buttons.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        <div class="tab-pane px-0" id="password" role="tabpanel">
                            <div class="auth-form">
                                {!! Form::model($user, ['route' => ['changePassword'], 'method' => 'post', 'class' => 'auth-form-container px-0']) !!}
                                <div class="row">
                                    <div class="form-group col-md-4 col-sm-12">
                                        {!! Form::label('current_password', __('forms.current_password') )!!}
                                        {!! Form::password('current_password', ['class' => 'form-control']) !!}
                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12">
                                        {!! Form::label('new_password', __('forms.new_password')) !!}
                                        {!! Form::password('new_password', ['class' => 'form-control']) !!}
                                        @error('new_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12">
                                        {!! Form::label('new_password_confirmation', __('forms.confirm_password')) !!}
                                        {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
                                        @error('new_password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-center mt-4">
                                        <button type="submit" class="col-sm-3 col-md-4 col-sm-12 py-2 auth-button" data-loading-text="Loading...">
                                            {{ __('buttons.save') }}
                                        </button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
