@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/promotions") }}">
                {{ __('menu.promotions') ?? '' }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $promotion->name ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <aside class="sidebar px-3 pt-1 pb-4">
                    <h5 class="sidebar-title">{{ __('names.promotions')}}</h5>
                    @include('user_views.promotion.promotion_tree')
                </aside>
            </div>
            <div class="col-lg-9">
                <div class="row">
                        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4 mt-4 mt-lg-0 gap-3">
                            <div>
                                <h4 class="mb-1 mb-lg-0" style="font-family: 'Times New Roman', sans-serif">{{ $promotion->name }}</h4>
                                <div class="text-muted">
                                    {{ __('names.showing') }}
                                    @if ($products->currentPage() !== $products->lastPage())
                                        {{ ($products->count() * $products->currentPage() - $products->count() + 1).__('–').($products->count() * $products->currentPage()) }}
                                    @else
                                        @if ($products->total() - $products->count() === 0)
                                            {{ $products->count() }}
                                        @else
                                            {{ ($products->total() - $products->count()).__('–').$products->total() }}
                                        @endif
                                    @endif
                                    {{ __('names.of') }}
                                    {{ $products->total().' '.__('names.entries') }}
                                </div>
                            </div>
                            <a href="{{ url("/promotions") }}" class="promotion-return-button">
                                {{ __('buttons.backToAllPromotions') }}
                            </a>
                        </div>
                        @forelse ($products as $product)
                            <div class="col-lg-4 col-md-6 mt-4 mt-md-0 mt-lg-0 mb-5">
                                @include('user_views.product.products_grid')
                            </div>
                        @empty
                            <span class="text-muted">{{ __('names.noProducts') }}</span>
                        @endforelse
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
