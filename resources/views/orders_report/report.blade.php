    <table>
        <thead>
            <tr>
                <th>{{__('table.orderId')}}</th>
                <th>{{__('table.user')}}</th>
                <th>{{__('table.created_at')}}</th>
                <th>{{__('table.status')}}</th>
            </tr>
        </thead>
        @forelse ($orders as $order)
        <tbody>
                <tr>
                    <td>{{ $order->id ?? '-' }}</td>
                    <td>{{ $order->user->name ?? '-' }}</td>
                    <td>{{ $order->created_at ?? '-' }}</td>
                    <td>{{ $order->status->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>{{__('table.productName')}}</th>
                    <th>{{__('table.pricePerItem')}}</th>
                    <th>{{__('table.count')}}</th>
                    <th>{{__('table.subTotal')}}</th>
                </tr>
                @forelse ($orderItems as $orderItem)
                    @if ($orderItem->order_id === $order->id)
                        <tr>
                            <td>{{ $orderItem->product->name ?? '-' }}</td>
                            <td>{{ $orderItem->price_current ?? '-' }}</td>
                            <td>{{ $orderItem->count ?? '-' }}</td>
                            <td>{{ $orderItem->subtotal ?? '-' }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="8">{{__('reports.noOrderItems')}}</td>
                    </tr>
                @endforelse
                <tr>
                    <th>{{__('table.sum')}}:</th>
                    <th>{{ $order->total[0]->total_price_current ?? '-' }}</th>
                    <th>{{ $order->total[0]->total_count ?? '-' }}</th>
                    <th>{{ $order->total[0]->total_price ?? '-' }}</th>
                </tr>
            </tbody>
        @empty
            <tr>
                <td colspan="8">{{__('noOrders')}}</td>
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

    table tbody tr:nth-child(2) {
        background-color: #f2f2f2;
    }

    @media screen and (max-width: 1500px) {
        table {
            border: 0;
            font-size: 0.8em;
        }
    }
</style>
