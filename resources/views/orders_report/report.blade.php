<table>
    <thead>
    <tr>
        <th style="min-width: 60px">{{__('table.id')}}</th>
        <th style="min-width: 100px">{{__('table.user')}}</th>
        <th style="min-width: 100px">{{__('table.employee')}}</th>
        <th style="min-width: 200px">{{__('table.name')}}</th>
        <th style="min-width: 250px">{{__('table.description')}}</th>
        <th style="min-width: 80px">{{__('table.budget')}}</th>
        <th style="min-width: 60px">{{__('table.totalHours')}}</th>
        <th style="min-width: 60px">{{__('table.completeHours')}}</th>
        <th style="min-width: 120px">{{__('table.startDate')}}</th>
        <th style="min-width: 120px">{{__('table.endDate')}}</th>
        <th style="min-width: 100px">{{__('table.status')}}</th>
        <th style="min-width: 160px">{{__('table.created_at')}}</th>
    </tr>
    </thead>
    @forelse ($orders as $order)
        <tbody>
        <tr>
            <td style="margin-left: 10px">{{ $order->id ?? '-' }}</td>
            <td>{{ $order->user->name ?? '-' }}</td>
            <td>{{ $order->employee->name ?? '-' }}</td>
            <td>{{ $order->name ?? '-' }}</td>
            <td>{{ $order->description ?? '-' }}</td>
            <td>€{{ number_format($order->budget * $order->total_hours, 2) ?? '-' }}</td>
            <td>{{ $order->total_hours ?? '-' }}</td>
            <td>{{ $order->complete_hours ?? '-' }}</td>
            <td>{{ $order->start_date->format('Y-m-d') ?? '-' }}</td>
            <td>{{ $order->end_date->format('Y-m-d') ?? '-' }}</td>
            <td>{{ $statuses[$order->status_id] ?? '-' }}</td>
            <td>{{ $order->created_at->format('Y-m-d H:i') ?? '-' }}</td>
        </tr>
        {{--                <tr>--}}
        {{--                    <th>{{__('table.productName')}}</th>--}}
        {{--                    <th>{{__('table.pricePerItem')}}</th>--}}
        {{--                    <th>{{__('table.count')}}</th>--}}
        {{--                    <th>{{__('table.subTotal')}}</th>--}}
        {{--                </tr>--}}
        {{--                @forelse ($orderItems as $orderItem)--}}
        {{--                    @if ($orderItem->order_id === $order->id)--}}
        {{--                        <tr>--}}
        {{--                            <td>{{ $orderItem->product->name ?? '-' }}</td>--}}
        {{--                            <td>{{ $orderItem->price_current ?? '-' }}</td>--}}
        {{--                            <td>{{ $orderItem->count ?? '-' }}</td>--}}
        {{--                            <td>{{ $orderItem->subtotal ?? '-' }}</td>--}}
        {{--                        </tr>--}}
        {{--                    @endif--}}
        {{--                @empty--}}
        {{--                    <tr>--}}
        {{--                        <td colspan="8">{{__('reports.noOrderItems')}}</td>--}}
        {{--                    </tr>--}}
        {{--                @endforelse--}}
        {{--                <tr>--}}
        {{--                    <th>{{__('table.sum')}}:</th>--}}
        {{--                    <th>{{ $order->total[0]->total_price_current ?? '-' }}</th>--}}
        {{--                    <th>{{ $order->total[0]->total_count ?? '-' }}</th>--}}
        {{--                    <th>{{ $order->total[0]->total_price ?? '-' }}</th>--}}
        {{--                </tr>--}}
        </tbody>
    @empty
        <tr>
            <td colspan="12" class="text-muted py-3">{{ __('table.emptyTable') }}</td>
        </tr>
    @endforelse
</table>

<style>
    .table > :not(caption) > * > * {
        padding: 0;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        font-size: 1rem;
    }

    table tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35em;
    }

    table th,
    table td {
        padding-inline: 1rem;
    }

    table thead tr:nth-child(1) {
        background-color: #e3e3e3;
    }
</style>
