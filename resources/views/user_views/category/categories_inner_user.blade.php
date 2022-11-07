@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ Auth::user() ? url("/user/rootcategories") : url("/rootcategories") }}">
                {{ __('menu.categories') ?? '' }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $maincategory->name ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <aside class="sidebar px-4 pt-2 pb-4">
                    <h4 class="sidebar-title">{{ __('names.categories')}}</h4>
                    @include('user_views.category.categoryTree')
                </aside>
            </div>
            <div class="col-lg-9">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4 mt-4 mt-lg-0 gap-3">
                    <div>
                        <h4 class="mb-1 mb-lg-0" style="font-family: 'Times New Roman', sans-serif">{{ $maincategory->name }}</h4>
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
                    <a href="{{ route("rootcategories") }}" class="category-return-button">{{__('buttons.backToMainCategories')}}</a>
                </div>
                <div class="row">
                    @forelse ($products as $product)
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
                                                <span>{{ $product->average }}</span>
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
