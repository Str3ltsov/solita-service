    <table>
        <thead>
            <tr>
                <th>{{__('table.returnId')}}</th>
                <th>{{__('table.orderId')}}</th>
                <th>{{__('table.user')}}</th>
                <th>{{__('table.admin')}}</th>
                <th>{{__('table.code')}}</th>
                <th>{{__('table.description')}}</th>
                <th>{{__('table.created_at')}}</th>
                <th>{{__('table.status')}}</th>
            </tr>
        </thead>
        @forelse ($returns as $return)
        <tbody>
                <tr>
                    <td>{{ $return->id ?? '-' }}</td>
                    <td>{{ $return->order_id ?? '-' }}</td>
                    <td>{{ $return->user->name ?? '-' }}</td>
                    <td>{{ $return->admin->name ?? '-' }}</td>
                    <td>{{ $return->code ?? '-' }}</td>
                    <td>{{ $return->description ?? '-' }}</td>
                    <td>{{ $return->created_at ?? '-' }}</td>
                    <td>{{ $return->status->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th colspan="2">{{__('table.productName')}}</th>
                    <th colspan="2">{{__('table.pricePerItem')}}</th>
                    <th colspan="2">{{__('table.count')}}</th>
                    <th colspan="2" style="width: 200px">{{__('table.subTotal')}}</th>
                </tr>
                @forelse ($returnItems as $returnItem)
                    @if ($returnItem->return_id === $return->id)
                        <tr>
                            <td colspan="2">{{ $returnItem->product->name ?? '-' }}</td>
                            <td colspan="2">{{ $returnItem->price_current ?? '-' }}</td>
                            <td colspan="2">{{ $returnItem->count ?? '-' }}</td>
                            <td colspan="2">{{ $returnItem->subtotal ?? '-' }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="8">{{__('reports.noReturnItems')}}</td>
                    </tr>
                @endforelse
                <tr>
                    <th colspan="2">Total:</th>
                    <th colspan="2">{{ $return->total[0]->total_price_current ?? '-' }}</th>
                    <th colspan="2">{{ $return->total[0]->total_count ?? '-' }}</th>
                    <th colspan="2">{{ $return->total[0]->total_price ?? '-' }}</th>
                </tr>
            </tbody>
        @empty
            <tr>
                <td colspan="8">{{__('reports.noReturns')}}</td>
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
