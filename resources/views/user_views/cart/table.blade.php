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
                    <span class="amount font-weight-medium text-color-grey">€{{ number_format($item->price_current,2) }}</span>
                </td>
                <td class="product-quantity">
                    <div class="quantity d-flex w-50">
                        <input readonly type="text" class="product-change-cart-number text-start" title="Qty" value="{{ $item->count }}" name="quantity" min="1" max="5" minlength="1" maxlength="5">
                    </div>
                </td>
                <td class="product-subtotal text-end">
                    <span>€{{ $item->price_current * $item->count }}</span>
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
