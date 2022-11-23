<div class="table-responsive">
    <table class="shop_table">
        <thead>
        <tr class="text-dark">
            <th class="product-thumbnail" width="15%">
            </th>
            <th class="product-name" width="30%">
                {{ __('names.product') }}
            </th>
            <th class="product-price" width="15%">
                {{ __('names.price') }}
            </th>
            <th class="product-quantity" width="20%">
                {{ __('names.quantity') }}
            </th>
            <th class="product-subtotal text-end" width="20%">
                {{ __('names.subtotal') }}
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($cartItems as $item)
            <tr class="cart_table_item">
                <td class="product-thumbnail">
                    <div class="product-thumbnail-wrapper">
                        {!! Form::open(['route' => ['userCartItemDestroy', $item->id], 'method' => 'delete']) !!}
                        <button type="submit" class="product-thumbnail-remove" title="{{ __('names.removeProduct') }}"
                                onclick="return confirm('{{ __('messages.areYouSureCart') }}?')">
                            <i class="fas fa-times"></i>
                        </button>
                        {!! Form::close() !!}
                        <a href="{{ route('viewproduct', $item['product']->id) }}" title="{{ $item['product']->name }}">
                            <img alt="{{ $item['product']->name }}" class="product-thumbnail-image"
                                 src="@if ($item['product']->image) {{ $item['product']->image }} @else /images/noimage.jpeg @endif">
                        </a>
                    </div>
                </td>
                <td class="product-name">
                    <a href="{{ route('viewproduct', $item['product']->id) }}">
                        {{ $item['product']->name }}
                    </a>
                </td>
                <td class="product-price">
                    <span class="amount font-weight-medium text-color-grey">€{{ number_format($item->price_current, 2) }}</span>
                </td>
                <td class="product-quantity">
                    <div class="d-flex w-75">
                        <input type="button" class="minus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="-" id="quantityButton">
                        {!! Form::number('count', $item->count, ['class' => 'product-add-to-cart-number', "min" => "1", "max" => "5", "minlength" => "1", "maxlength" => "5", "oninput" => "this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"]) !!}
                        <input type="button" class="plus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="+" id="quantityButton">
                        <input type="hidden" name="id" value="{{ $item->id }}">
                    </div>
                </td>
                <td class="product-subtotal text-end">
                    <span id="cart_subtotal">€{{ $item->price_current * $item->count }}</span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="12" class="text-center">{{ __('names.emptyCart') }}</td>
            </tr>
        @endforelse
        <tr>
            <td colspan="5"></td>
        </tr>
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        $(document).ready(() => {
            let cartItemQuantities = document.querySelectorAll('.product-add-to-cart-number');
            let cartItemIds = document.querySelectorAll('input[name="id"]');
            let quantityButtons = document.querySelectorAll('#quantityButton');

            cartItemQuantities.forEach((cartItemQuantity, index) => {
                $(quantityButtons).on('click', event => {
                    event.preventDefault();

                    let data = {
                        '_token': "{{ csrf_token() }}",
                        'quantity': $(cartItemQuantity).val(),
                        'productId': $(cartItemIds[index]).val(),
                    };

                    $.ajax({
                        url: '{{ route('updateCart') }}',
                        type: 'POST',
                        data: data,
                        dataType: 'html',
                        success: response => {
                            const cartSubtotals = document.querySelectorAll('#cart_subtotal');
                            $(cartSubtotals[index]).text(`€${JSON.parse(response).subtotal}`);
                            $('#cart_total').text(`€${JSON.parse(response).total}`);
                        },
                        error: (XMLHttpRequest, textStatus, errorThrown) => {
                            $('#cart_message').html(XMLHttpRequest || textStatus || errorThrown);
                        }
                    });
                });
            });
        });
    </script>
@endpush
