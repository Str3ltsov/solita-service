@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $user->name ?? '' }}
            </span>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/users/{$user->id}/reviewws") }}">
                {{ __('names.reviews') }}
            </a>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <h3 class="mt-3 mb-4" style="font-family: 'Times New Roman', sans-serif">
                        {{ __('table.user') }}: {{ $user->name }}
                    </h3>
                </div>
                <div class="row bg-white mx-0 px-4 py-3 pb-4 mb-4 product-section">
                    <div class="ps-0 d-flex justify-content-between align-items-center">
                        <h5 class="mt-2 mb-3">
                            {{ __('names.reviews') }}
                            {{ __('(') }}
                            @if (count($reviews) > 0) {{ $reviews->total() }} @else 0 @endif
                            {{ __(')') }}
                        </h5>
                        <div class="d-flex align-items-center fs-5 fw-bold">
                            <span>{{ round(number_format($reviewAverageRating, 2), 1) }}</span>
                            <span>/</span>
                            <span>5</span>
                            @if ($reviewAverageRating > 0)
                                <i class="fa-solid fa-star text-warning ms-2"></i>
                            @else
                                <i class="fa-regular fa-star text-warning ms-2"></i>
                            @endif
                        </div>
                    </div>
                    @include('user_views.reviews.reviews')
                    @if (count($reviews) > 0)
                        <div class="d-flex mt-3">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                </div>
                @if ($user->id !== auth()->user()->id)
                    <div class="row bg-white mx-0 px-4 py-3 pb-4 mb-4 product-section">
                        <h5 class="mt-2 mb-3">{{ __('names.addReview') }}</h5>
                        <div class="row">
                            @include('user_views.reviews.review_form')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
