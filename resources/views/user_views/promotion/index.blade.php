@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.promotions') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @if (count($promotions) > 0)
                <div class="col-lg-3">
                    <aside class="sidebar px-3 pt-1 pb-4">
                        <h5 class="sidebar-title">{{ __('names.promotions')}}</h5>
                        @include('user_views.promotion.promotion_tree')
                    </aside>
                </div>
            @endif
            <div class="@if (count($promotions) === 0) col-lg-12 @else col-lg-9 @endif">
                <div class="row">
                    @forelse ($promotions as $promotion)
                        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4 mt-4 mt-lg-0 gap-3">
                            <div>
                                <h4 class="mb-1 mb-lg-0">{{ $promotion->name }}</h4>
                                <div class="text-muted mb-2 mb-lg-0">
                                    {{ count($promotion->products).' '.__('names.entries') }}
                                </div>
                            </div>
                            <a href="{{ route("promotion", ["id" => $promotion->id]) }}" class="promotion-more-products-button">
                                {{ __("names.more_for_promotions") }}
                            </a>
                        </div>
                        @forelse ($promotion->products as $product)
                            <div class="col-lg-4 col-md-6 mt-4 mt-md-0 mt-lg-0 mb-5">
                                @include('user_views.product.products_grid')
                            </div>
                            @if ($loop->iteration > 2)
                                @break
                            @endif
                        @empty
                            <span class="text-muted">{{ __('names.noProducts') }}</span>
                        @endforelse
                        <hr class="mb-5" style="background: #ccc">
                    @empty
                        <span class="text-muted mt-1">{{ __('names.noPromotions') }}</span>
                    @endforelse
                    <div class="d-flex justify-content-center">
                        {{ $promotions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
