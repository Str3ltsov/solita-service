@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.categories') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mt-3 mb-4">
                    <h3>
                        {{ __('names.categories') }}
                    </h3>
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <a href="{{ route('categories.create') }}"
                           class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-plus fs-6 me-2"></i>
                            {{ __('buttons.addNew') }}
                        </a>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3 border-around">
                    <div class="table table-responsive">
                        @include('categories.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


