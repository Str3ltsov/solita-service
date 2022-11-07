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
            @if (count($promotions) === 0)
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
                                <h4 class="mb-1 mb-lg-0" style="font-family: 'Times New Roman', sans-serif">{{ $promotion->name }}</h4>
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
                                <div class="product">
                                    {!! Form::open(['route' => ['addtocart'], 'method' => 'post']) !!}
                                        @if ($product->image)
                                            <div class="product-image-container">
                                                <a style="cursor: pointer" href="{{ route('viewproduct', $product->id) }}">
                                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image mx-auto"/>
                                                </a>
                                                <div class="product-add-to-cart-wrapper">
                                                    <div class="d-flex justify-content-center justify-content-lg-start">
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        <button type="submit" class="text-decoration-none product-add-to-cart-button" title="Add to Cart">
                                                            <i class="fa-solid fa-bag-shopping"></i>
                                                            {{ __('buttons.addToCart') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="product-image-container">
                                                <a style="cursor: pointer" href="{{ route('viewproduct', $product->id) }}">
                                                    <img src="/images/noimage.jpeg" alt="" class="product-image mx-auto"/>
                                                </a>
                                                <div class="product-add-to-cart-wrapper">
                                                    <div class="d-flex justify-content-center justify-content-lg-start">
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        <button type="submit" class="text-decoration-none product-add-to-cart-button" title="Add to Cart">
                                                            <i class="fa-solid fa-bag-shopping"></i>
                                                            <span>{{ __('buttons.addToCart') }}</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="product-information">
                                            <div class="product-title-container">
                                                <a class="product-title" href="{{ route('viewproduct', $product->id) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="product-rating">
                                                    <span>{{ $product->average ?? 0 }}</span>
                                                    <span>/</span>
                                                    <span>5</span>
                                                    @if ($product->average > 0)
                                                        <i class="fa-solid fa-star text-warning ms-1"></i>
                                                    @else
                                                        <i class="fa-regular fa-star text-warning ms-1"></i>
                                                    @endif
                                                </div>
                                                <div class="product-price">
                                                    @if ($product->discount)
                                                        <span class="product-previous-price product-price-font-family">
                                                        €{{ number_format($product->price,2) }}
                                                    </span>&nbsp
                                                        <span class="product-discounted-price product-price-font-family">
                                                        €{{ $product->price - (round(($product->price * $product->discount->proc / 100), 2)) }}
                                                    </span>
                                                    @else
                                                        <span class="product-no-discount-price product-price-font-family">
                                                        €{{ number_format($product->price,2) }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="w-100 d-flex justify-content-center flex-column mt-3">
                                                <div class="d-flex justify-content-center">
                                                    <input type="button" class="minus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="-">
                                                    {!! Form::number('count', "1", ['class' => 'product-add-to-cart-number', "min" => "1", "max" => "5", "minlength" => "1", "maxlength" => "5", "oninput" => "this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"]) !!}
                                                    <input type="button" class="plus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="+">
                                                </div>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
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
