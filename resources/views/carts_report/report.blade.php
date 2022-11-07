    <table>
        <thead>
            <tr>
                <th>{{__('table.cartId')}}</th>
                <th>{{__('table.user')}}</th>
                <th>{{__('table.code')}}</th>
                <th>{{__('table.created_at')}}</th>
                <th>{{__('table.status')}}</th>
            </tr>
        </thead>
        @forelse ($carts as $cart)
            <tbody>
                <tr>
                    <td>{{ $cart->id ?? '-' }}</td>
                    <td>{{ $cart->user->name ?? '-' }}</td>
                    <td>{{ $cart->code ?? '-' }}</td>
                    <td>{{ $cart->created_at ?? '-' }}</td>
                    <td>{{ $cart->status->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th colspan="2">{{__('table.productName')}}</th>
                    <th>{{__('table.pricePerItem')}}</th>
                    <th>{{__('table.count')}}</th>
                    <th>{{__('table.subTotal')}}</th>
                </tr>
                @forelse ($cartItems as $cartItem)
                    @if ($cartItem->cart_id === $cart->id)
                        <tr>
                            <td colspan="2">{{ $cartItem->product->name ?? '-' }}</td>
                            <td>{{ $cartItem->price_current ?? '-' }}</td>
                            <td>{{ $cartItem->count ?? '-' }}</td>
                            <td>{{ $cartItem->subtotal ?? '-' }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="8">{{__('reports.noCartItems')}}</td>
                    </tr>
                @endforelse
                <tr>
                    <th colspan="2">{{__('table.sum')}}:</th>
                    <th>{{ $cart->total[0]->total_price_current ?? '-' }}</th>
                    <th>{{ $cart->total[0]->total_count ?? '-' }}</th>
                    <th>{{ $cart->total[0]->total_price ?? '-' }}</th>
                </tr>
            </tbody>
        @empty
            <tr>
                <td colspan="8">{{__('reports.noCarts')}}</td>
            </tr>
        @endforelse
    </table>

<style>
    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        font-size: 1vw;
    }

    table tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35em;
    }

    table th,
    table td {
        padding: .625em;
    }

    table th {
        font-size: .85em;
    }

    table thead tr:nth-child(1) {
        background-color: #d4d4d4;
    }

    table tbody tr:nth-child(1) {
        background-color: #e7e7e7;
    }

    @media screen and (max-width: 1500px) {
        table {
            border: 0;
            font-size: 0.8em;
        }
    }
</style>
