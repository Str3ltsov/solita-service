<form method="get" action="{{ route("rootcategories") }}" class="auth-form-container row gap-4 gap-md-0">
    <div class="col-12 d-flex flex-column gap-4">
        <div class="row bg-white m-md-0 px-2 py-4">
            <h5 class="mb-4">{{ __('names.filters') }}</h5>
            <div class="d-flex flex-column flex-md-row gap-4 gap-md-5">
                <div class="input-group">
                    <input type="text" name="filter[namelike]" class="form-control product-search-input"
                           id="filter[namelike]" placeholder="{{ __('names.search').'...' }}"
                           value="{{ $filter["namelike"] ?? "" }}">
                </div>
                <div class="input-group">
                    {!! Form::select('order', $orderList, $selectedOrder, ['class' => 'form-select', 'style' => 'cursor: pointer; border-color: #ddd; padding: 15px 20px']) !!}
                </div>
                <div class="d-flex justify-content-center w-100 my-2 my-md-0">
                    <button type="submit" class="category-return-button col-12 px-4">
                        {{ __('buttons.filter') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('css')
    <style>
        .product-search-input {
            border-color: #ddd;
            border-radius: 0;
            font-size: .9em !important;
        }

        .product-search-input::placeholder {
            color: #bbb;
        }

        .product-search-button {
            font-size: 1em !important;
            background: #FFA600FF;
            color: #222222FF;
            border: none;
            border-radius: 0;
            text-transform: uppercase;
            text-align: center;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            transition: all 200ms ease;
        }

        .product-search-button:hover,
        .product-search-button:focus,
        .product-search-button:active {
            background: #FFA600FF;
            color: #222222FF;
        }
    </style>
@endpush

