@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/employee/returns") }}">
                {{ __('menu.returns') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $return->id ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="row mb-4">
                    <div class="d-flex flex-column">
                        <h3 class="mt-3 mb-2" style="font-family: 'Times New Roman', sans-serif">
                            {{__('names.return')}}: {{ $return->id }}
                        </h3>
                        <div class="d-flex gap-2 text-muted">
                            {{__('table.user')}}:
                            <a href="{{ route('userReviews', [$return->user_id]) }}" class="fw-bold d-flex gap-1">
                                {{ __($return->user->name) }}
                                <div class="d-flex align-items-center">
                                    <span>{{ round(number_format($reviewAverageRating['user'], 2), 1) }}</span>
                                    <span>/</span>
                                    <span>5</span>
                                    @if ($reviewAverageRating > 0)
                                        <i class="fa-solid fa-star text-warning ms-1"></i>
                                    @else
                                        <i class="fa-regular fa-star text-warning ms-1"></i>
                                    @endif
                                </div>
                            </a>
                        </div>
                        <div class="d-flex gap-2 text-muted">
                            {{__('table.specialist')}}:
                            <a href="{{ route('userReviews', [$return->specialist_id]) }}" class="fw-bold d-flex gap-1">
                                {{ __($return->specialist->name) }}
                                <div class="d-flex align-items-center">
                                    <span>{{ round(number_format($reviewAverageRating['specialist'], 2), 1) }}</span>
                                    <span>/</span>
                                    <span>5</span>
                                    @if ($reviewAverageRating > 0)
                                        <i class="fa-solid fa-star text-warning ms-1"></i>
                                    @else
                                        <i class="fa-regular fa-star text-warning ms-1"></i>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row bg-white mx-0 p-3 pb-4 mb-4">
                    <h5 class="mt-2 mb-3">{{ __('names.editReturn') }}</h5>
                    @include('employee_views.returns.update_form')
                </div>
                <div class="row bg-white mx-0 p-3 mb-4">
                    <h5 class="my-2">{{ __('names.products') }}</h5>
                    <div class="table table-responsive">
                        @include('employee_views.returns.tables.return_item_table')
                    </div>
                </div>
                <div class="row bg-white mx-0 p-3">
                    <h5 class="my-2">{{ __('names.orderHistory') }}</h5>
                    @include('employee_views.log_table')
                </div>
            </div>
        </div>
    </div>
@endsection
