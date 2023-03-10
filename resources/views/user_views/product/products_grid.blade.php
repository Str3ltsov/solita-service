<div class="product">
    @if ($product->image)
        <div class="product-image-container">
            <a style="cursor: pointer" href="{{ route('viewproduct', $product->id) }}">
                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                     class="product-image mx-auto"/>
            </a>
{{--            <div class="product-add-to-cart-wrapper">--}}
{{--                <div class="d-flex justify-content-center justify-content-lg-start">--}}
{{--                    <input type="hidden" name="id" value="{{ $product->id }}">--}}
{{--                    <button type="submit"--}}
{{--                            class="text-decoration-none product-add-to-cart-button"--}}
{{--                            title="Add to Cart">--}}
{{--                        <i class="fa-solid fa-bag-shopping"></i>--}}
{{--                        <span>{{ __('buttons.addToCart') }}</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    @else
        <div class="product-image-container">
            <a style="cursor: pointer" href="{{ route('viewproduct', $product->id) }}">
                <img src="{{ asset('images/noimage.jpeg') }}" alt=""
                     class="product-image mx-auto"/>
            </a>
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
                        €{{ number_format($product->price,2).'/'.__('names.shortPerHour') }}
                    </span>&nbsp
                    <span class="product-discounted-price product-price-font-family">
                        €{{ $product->price - (round(($product->price * $product->discount->proc / 100), 2)) }}{{ '/'.__('names.shortPerHour') }}
                    </span>
                @else
                    <span class="product-no-discount-price product-price-font-family">
                        €{{ number_format($product->price,2).'/'.__('names.shortPerHour') }}
                    </span>
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4 mb-2">
            <div class="d-flex justify-content-center w-100">
                <a href="{{ route('getCreateOrder', [$prefix, $product->id]) }}"
                   class="category-return-button px-4 col-lg-9 col-md-10 col-12"
                   title="{{ __('buttons.order') }}">
                    <i class="fa-solid fa-bag-shopping me-2 fs-6"></i>
                    <span>{{ __('buttons.order') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
