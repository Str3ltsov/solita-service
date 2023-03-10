@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.dataExpImp') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mt-3 mb-4">
                    <h3 class="mb-4 mb-md-0">
                        {{ __('names.dataExpImp') }}
                    </h3>
                </div>
                <div class="row bg-white mx-md-0 p-3 mb-4 border-around">
                    <h5 class="mt-1 mb-3">{{ __('names.export') }}</h5>
                    @include('data_export_import.export_form')
                </div>
                <div class="row bg-white mx-md-0 p-3 border-around">
                    <h5 class="mt-1 mb-3">{{ __('names.import') }}</h5>
                    @include('data_export_import.import_form')
                </div>
            </div>
        </div>
    </div>
@endsection




