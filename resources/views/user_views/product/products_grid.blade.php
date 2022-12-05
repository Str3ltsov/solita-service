<div class="product">
    {!! Form::open(['route' => ['addtocart', $prefix], 'method' => 'post']) !!}
    @if ($product->image)
        <div class="product-image-container">
            <a style="cursor: pointer" href="{{ route('viewproduct', $product->id) }}">
                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                     class="product-image mx-auto"/>
            </a>
            <div class="product-add-to-cart-wrapper">
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <button type="submit"
                            class="text-decoration-none product-add-to-cart-button"
                            title="Add to Cart">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span>{{ __('buttons.addToCart') }}</span>
                    </button>
                </div>
            </div>
        </div>
    @else
        <div class="product-image-container">
            <a style="cursor: pointer" href="{{ route('viewproduct', $product->id) }}">
                <img src="{{ asset('images/noimage.jpeg') }}" alt=""
                     class="product-image mx-auto"/>
            </a>
            <div class="product-add-to-cart-wrapper">
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <button type="submit"
                            class="text-decoration-none product-add-to-cart-button"
                            title="Add to Cart">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span>{{ __('buttons.addToCart') }}</span>
                    </button>
                    <!--<div class="product-add-to-cart-text">{{ __('buttons.addToCart') }}</div>-->
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
                <input type="button"
                       class="minus text-color-hover-light bg-color-hover-primary border-color-hover-primary"
                       value="-">
                {!! Form::number('count', "1", ['class' => 'product-add-to-cart-number', "min" => "1", "max" => "5", "minlength" => "1", "maxlength" => "5", "oninput" => "this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"]) !!}
                <input type="button"
                       class="plus text-color-hover-light bg-color-hover-primary border-color-hover-primary"
                       value="+">
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
