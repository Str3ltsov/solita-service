@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/products") }}">
                {{ __('menu.products') ?? '' }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $product->name ?? '' }}
            </span>
        </div>
    </div>
    <div class="container product-section">
        <div class="row">
            <div class="col-lg-12">
                <div class="row mb-4 mx-1 mx-md-0">
                    <div class="col-md-6 mb-md-0 mb-4">
                        <div>
                            @if ($product->image)
                                <div>
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                         class="d-block w-100"/>
                                </div>
                            @else
                                <div>
                                    <img src="/images/noimage.jpeg" alt="" class="d-block w-100"/>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="summary entry-summary position-relative">
                            <h3 class="mb-0 product-title">{{ $product->name }}</h3>
                            <div class="pb-0 clearfix d-flex align-items-center mt-2">
                                <div class="product-rating">
                                    <span>{{ $average }}</span>
                                    <span>/</span>
                                    <span>5</span>
                                    @if ($average > 0)
                                        <i class="fa-solid fa-star ms-1 text-warning"></i>
                                    @else
                                        <i class="fa-regular fa-star ms-1 text-warning"></i>
                                    @endif
                                </div>
                                <div class="review-num">
                                    <a href="#description" class="text-decoration-none link" data-hash="" data-hash-offset="0" data-hash-offset-lg="75" onclick="setTimeout(() => document.querySelector('.nav-link-reviews').click(), 500)">
                                        <span class="count text-color-inherit" itemprop="ratingCount">
                                            {{ __('names.reviews').' ('.$rateCount.')' }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="divider divider-small">
                                <hr class="bg-color-grey-scale-4">
                            </div>
                            <p class="price">
                                @if ($product->discount)
                                    <span class="amount">€{{ $product->price }}</span>
                                    <span class="sale">€{{ $product->price - (round(($product->price * $product->discount->proc / 100), 2)) }}</span>
                                @else
                                    <span class="default-price">€{{ $product->price }}</span>
                                @endif
                            </p>
{{--                            <p class="my-3">{{ $product->description }}</p>--}}
                            <ul class="list list-unstyled text-2">
                                <li class="mb-0">
                                    <span class="fw-bold">{{ __('names.categories') }}:</span>
                                    @forelse ($product->categories as $category)
                                        <a class="link" href="{{ url("/innercategories/$category->id") }}">
                                            {{ $category->name }}@if (!$loop->last),@endif
                                        </a>
                                    @empty
                                        <span class="fw-normal text-dark">{{ __('names.noCategories') ?? '-' }}</span>
                                    @endforelse
                                </li>
                            </ul>
{{--                            <div class="d-flex align-items-center gap-1">--}}
{{--                                <i class="fa-solid fa-truck fs-4 me-1" style="color: #aaa"></i>--}}
{{--                                <div class="d-flex flex-column" style="line-height: 20px">--}}
{{--                                    <span class="fw-bold text-muted">{{ __('table.deliveryTime') }}</span>--}}
{{--                                    <span>{{ $product->delivery_time.' '.__('names.days') }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="d-flex flex-column flex-sm-row gap-sm-3 gap-2">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fa-solid fa-calendar-days fs-4 me-2" style="color: #aaa"></i>
                                    <div class="d-flex flex-column" style="line-height: 20px">
                                        <span class="fw-bold text-muted">{{ __('table.created_at') }}</span>
                                        <span>{{ $product->created_at ? $product->created_at->format('Y-m-d') : '-' }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="fa-solid fa-calendar-days fs-4 me-2" style="color: #aaa"></i>
                                    <div class="d-flex flex-column" style="line-height: 20px">
                                        <span class="fw-bold text-muted">{{ __('table.updated_at') }}</span>
                                        <span>{{ $product->updated_at ? $product->updated_at->format('Y-m-d') : '-' }}</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <a href="{{ route('getCreateOrder', [$prefix, $product->id]) }}" class="category-return-button col-lg-5 col-md-6 col-12">
                                <i class="fa-solid fa-bag-shopping me-2 fs-6"></i>
                                {{ __('buttons.order') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4 mt-5 mt-md-0 mx-1 mx-md-0">
            <div class="col">
                <div id="description" class="tabs tabs-simple tabs-simple-full-width-line tabs-product tabs-dark mb-2">
                    <ul class="nav nav-tabs justify-content-start" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active py-2 px-3" href="#productDescription" data-bs-toggle="tab" aria-selected="true" role="tab">
                                {{ __('names.description') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link nav-link-reviews py-2 px-3" href="#productReviews" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
                                {{ __('names.reviews').' ('.$product->ratings->count().') ' }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-0">
                        <div class="tab-pane px-0 py-3 active" id="productDescription" role="tabpanel">
                            <p>{{ $product->description }}</p>
                        </div>
{{--                        <div class="tab-pane px-0 py-3" id="productInfo" role="tabpanel">--}}
{{--                            <table class="table table-striped m-0">--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <th class="border-top-0">--}}
{{--                                        Lorem:--}}
{{--                                    </th>--}}
{{--                                    <td class="border-top-0">--}}
{{--                                        Lorem ipsum dolor sit amet--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th>--}}
{{--                                        Lorem:--}}
{{--                                    </th>--}}
{{--                                    <td>--}}
{{--                                        Lorem ipsum dolor sit amet--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th>--}}
{{--                                        Lorem:--}}
{{--                                    </th>--}}
{{--                                    <td>--}}
{{--                                        Lorem ipsum dolor sit amet--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
                        <div class="tab-pane px-0 py-3" id="productReviews" role="tabpanel">
                            <ul class="comments">
                                @forelse ($product->ratings as $rating)
                                    <li>
                                        <div class="comment">
                                            <div class="comment-block">
                                                <div class="comment-arrow"></div>
                                                <span class="comment-by">
                                                    <strong>{{ $rating->user->name }}</strong>
                                                    <span class="mx-1">–</span>
                                                    <span>{{ $rating->created_at->format('F j, Y') }}</span>
                                                    <span class="float-end">
                                                        <div class="pb-0 comment-rating">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="product-rating-star @if ($rating->value >= $i) fa-solid fa-star
                                                                   @elseif ($rating->value >= $i - .5) fa-solid fa-star-half-stroke
                                                                   @else fa-regular fa-star @endif"></i>
                                                            @endfor
                                                        </div>
                                                    </span>
                                                </span>
                                                <p class="m-0 comment-description">{{ $rating->description  }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <p class="text-muted">{{ __('names.noReviews') }}</p>
                                @endforelse
                            </ul>
                            <hr class="solid my-5">
                            <h5 class="add-a-review-title">{{ __('names.addReview') }}</h5>
                            <div class="row">
                                <div class="col product-review-add-review-form" id="review-product">
                                    @if (!$voted)
                                        {{--@guest
                                            <div class="mb-3 col-sm-6">
                                                <label class="form-label">Name*</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="mb-3 col-sm-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" placeholder="">
                                            </div>
                                        @endguest--}}
                                        @guest
                                            <p class="product-reviews-add-review-description">{{ __('names.loginToReview') }}</p>
                                        @endguest
                                        @auth
                                            <div class="col-sm-12">
                                                <label class="form-label required text-dark fw-bold">
                                                    {{ __('names.rating') }}
                                                    <span>*</span>
                                                </label>
                                                <div class="rating" style="gap: 5px">
                                                    <input type="radio" name="rating" value="5" id="5"><label for="5">
                                                        <i class="fa-regular fa-star"></i>
                                                    </label>
                                                    <input type="radio" name="rating" value="4" id="4"><label for="4">
                                                        <i class="fa-regular fa-star"></i>
                                                    </label>
                                                    <input type="radio" name="rating" value="3" id="3"><label for="3">
                                                        <i class="fa-regular fa-star"></i>
                                                    </label>
                                                    <input type="radio" name="rating" value="2" id="2"><label for="2">
                                                        <i class="fa-regular fa-star"></i>
                                                    </label>
                                                    <input type="radio" name="rating" value="1" id="1"><label for="1">
                                                        <i class="fa-regular fa-star"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="form-label required text-dark fw-bold">
                                                    {{ __('names.review') }}
                                                    <span>*</span>
                                                </label>
                                                <div class="mb-3">
                                                    <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="button" class="product-reviews-add-review-submit">
                                                    {{ __('buttons.postReview') }}
                                                </button>
                                            </div>
                                        @endauth
                                    @else
                                        <p class="product-reviews-add-review-description">{{ __('names.alreadyReviewed') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.product-reviews-add-review-submit').click(function () {
            const value = $('input[type=radio][name=rating]:checked').val();
            const desc = $('textarea#comment').val();
            console.log(desc);
            $.post("{{ route('addUserRating', $prefix) }}",
                {
                    "_token": "{{ csrf_token() }}",
                    rating: value,
                    description: desc,
                    product: {{ $product->id }}
                },
                function (data, status) {
                    data.val == "ok" && $('#review-product').html("<p>{{ __('names.reviewProduct') }}</p>");
                }
            );
        });
    </script>
@endpush
@push('css')
    <style>
        .badge {
            font-size: 25px;
            font-weight: 200
        }

        .badge i {
            font-size: 20px;
            font-weight: 200
        }

        .about-rating {
            font-size: 15px;
            font-weight: 500;
            margin-top: 10px
        }

        .total-ratings {
            font-size: 12px
        }

        .bg-custom {
            background-color: #b7dd29 !important
        }

        .progress {
            margin-top: 10px
        }

        /*    rating form*/
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center
        }

        .rating > input {
            display: none
        }

        .rating > label {
            position: relative;
            width: 1em;
            font-size: 6vw;
            color: #FFD600;
            cursor: pointer
        }

        .rating > label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating > label:hover:before,
        .rating > label:hover ~ label:before {
            opacity: 1 !important
        }

        .rating > input:checked ~ label:before {
            opacity: 1
        }

        .rating:hover > input:checked ~ label:before {
            opacity: 0.4
        }
    </style>
@endpush
