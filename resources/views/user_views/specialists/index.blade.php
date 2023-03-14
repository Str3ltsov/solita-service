@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.specialists')  }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-9 col-12 order-1 order-lg-0">
                        <div class="col-12 mt-3 mb-4">
                            <h2 class="mb-0">
                                {{ __('names.specialists') }}
                            </h2>
                            <div class="text-muted mb-2 mb-lg-0">
                                {{ __('names.showing') }}
                                {{ count($specialists) }}
                                {{ __('names.of') }}
                                {{ count($specialists).' '.__('names.entries') }}
                            </div>
                        </div>
                        <div class="col-12">
                            @include('user_views.specialists.specialist_list')
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 order-0 order-lg-1">
                        @include('user_views.specialists.filters')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
