@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.products') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-lg-9 col-md-8 mb-5 order-last order-md-first">
                <div class="row mb-4 mt-5 mt-md-0 align-items-center">
                    <div class="col-lg-7">
                        <h2 class="p-0 m-0 mb-1 mb-lg-0 shop-title">
                            {{ __('names.products') }}
                        </h2>
                        <div class="text-muted mb-2 mb-lg-0">
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
                    <div class="col-lg-5">
                        <div class="d-flex gap-2">
                            {!! Form::select('productsPerPage', $paginate_list, $selectedProductsPerPage,
                                ['class' => 'form-select w-25', 'id' => 'perPageSelector', 'style' => 'cursor: pointer']) !!}
                            {!! Form::select('order', $order_list, $selectedOrder,
                                ['class' => 'form-select w-75', 'id' => 'orderSelector', 'style' => 'cursor: pointer']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6 mt-4 mt-md-0 mt-lg-0 mb-5">
                            @include('user_views.product.products_grid')
                        </div>
                    @empty
                        <span class="text-muted">{{ __('names.noProducts') }}</span>
                    @endforelse
                    <div class="d-flex justify-content-center">
                        {{ $products->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <aside class="sidebar">
                    <form method="get" action="{{ route("userproducts") }}" id="mainForm">
                        <div class="input-group mb-3 pb-1">
                            <input type="text" name="filter[namelike]" class="form-control product-search-input"
                                   id="filter[namelike]" placeholder="{{ __('names.search').'...' }}"
                                   value="{{$filter["namelike"] ?? ""}}">
                            <button type="submit" class="btn btn-primary p-2 product-search-button">
                                <i class="fas fa-search m-2"></i>
                            </button>
                        </div>
                        <h5 class="sidebar-title">{{ __('names.filterByPrice') }}</h5>
                        <div class="filter-by-price-widget-content">
                            <fieldset class="form-group">
                                <div id="range-slider" class="slider mb-3 mt-1 mx-1" wire:ignore></div>
                                <div class="filter-by-price-button-container mb-3">
                                    <div class="d-flex">
                                        <span>{{ __('names.price')}} (€):</span>
                                        <input type="text" id="filter[pricefrom]" name="filter[pricefrom]"
                                               readonly
                                               value="{{ $filter["pricefrom"] ?? '0' }}"
                                               class="border-0 text-end filter-by-price-number"
                                               style="max-width: 40px"/>
                                        <span class="text-center"> — </span>
                                        <input type="text" id="filter[priceto]" name="filter[priceto]" readonly
                                               value="{{ $filter["priceto"] ?? '0' }}"
                                               class="border-0 text-start filter-by-price-number"
                                               style="max-width: 40px"/>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <h5 class="sidebar-title">{{ __('names.categories') }}</h5>
                        <ul class="nav nav-list flex-column">
                            @forelse($categories as $category)
                                <div class="nav-link">
                                    <label class="form-check-label" style="cursor: pointer">
                                        <input class="form-check-input me-2" type="checkbox" value="{{ $category->id }}"
                                               id="category" onclick="calc();" name="filter[categories.id]" style="cursor: pointer"
                                        @if ($filter && array_key_exists('categories.id', $filter))
                                            {{ in_array($category->id, $selCategories) ? "checked=\"checked\"" : ""}}
                                            @endif>
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @empty
                                <div class="nav-link">
                                    <span class="text-muted">{{ __('names.noCategories') }}</span>
                                </div>
                            @endforelse
                            <input type="text" value="{{ implode(",", $selCategories) }}"
                                   name="filter[categories.id]" id="filter[categories.id]" class="d-none">
                        </ul>
                        <input type="hidden" id="order" name="order" value="{{ $selectedOrder }}">
                        <input type="hidden" id="paginate" name="productsPerPage"
                               value="{{ $selectedProductsPerPage }}">
                        <div class="d-flex justify-content-center w-100">
                            <button type="submit" class="btn btn-primary product-filter-button">
                                <i class="fa-solid fa-filter me-2"></i>
                                {{ __('buttons.filter') }}
                            </button>
                        </div>
                    </form>
                </aside>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('perPageSelector').onchange = () => {
                addPerPageValueToFilter();
                document.getElementById('mainForm').submit();
            }
            document.getElementById('orderSelector').onchange = () => {
                addOrderValueToFilter();
                document.getElementById('mainForm').submit();
            }

            const addPerPageValueToFilter = () => document.getElementById('paginate').value = $('#perPageSelector').val();
            const addOrderValueToFilter = () => document.getElementById('order').value = $('#orderSelector').val();

            const rangeSlider = document.getElementById('range-slider');
            const priceFrom = document.getElementById('filter[pricefrom]');
            const priceTo = document.getElementById('filter[priceto]');

            $(() => {
                $(rangeSlider).slider({
                    range: true,
                    min: 0,
                    max: {{ $maxPrice }},
                    values: [{{ $filter["pricefrom"] ?? 0 }}, {{ $filter["priceto"] ?? $maxPrice }}],
                    slide: (event, ui) => {
                        $(priceFrom).val(ui.values[0]);
                        $(priceTo).val(ui.values[1]);
                    }
                });
                $(priceFrom).val($(rangeSlider).slider("values", 0));
                $(priceTo).val($(rangeSlider).slider("values", 1));
            });

            function calc() {
                var elements = document.querySelectorAll("input[type='checkbox']");
                // console.log(elements);
                var value = '';
                for (var i = 0; i < elements.length; i++) {
                    value += elements[i].checked == true && value ? ',' : '';
                    value += elements[i].checked == true ? elements[i].value : "";
                }
                //console.log(value);
                document.getElementById("filter[categories.id]").value = value;
            }
        </script>
    @endpush
@endsection

