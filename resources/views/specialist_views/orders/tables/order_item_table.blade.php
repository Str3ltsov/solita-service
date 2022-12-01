<table class="table table-striped table-bordered my-3">
    <thead style="background: #e7e7e7;">
    <tr>
        <th class="text-center px-3">#</th>
        @if ($order->status->name == "Returned")
            <th class="px-3">{{__('table.status')}}</th>
        @endif
        <th class="px-3">{{__('table.productName')}}</th>
        <th class="px-3">{{__('table.count')}}</th>
        <th class="px-3">{{__('table.price')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orderItems as $orderItem)
        <tr>
            <td class="text-center px-3">{{ $loop->index + 1 }}</td>
            @if ($order->status->name == "Returned")
                <td class="px-3">
                    @if ($orderItem->isReturned !== null)
                        {{ $orderItem->isReturned }}
                    @endif
                </td>
            @endif
            <td class="px-3">{{ $orderItem->product->name }}</td>
            <td class="px-3">{{ $orderItem->count }}</td>
            <td class="px-3">{{ number_format($orderItem->price_current, 2) }} €</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot style="background: #e7e7e7;">
        <tr class="fw-bold" style="border-top: 2px solid black">
            <td class="px-3 text-center">#</td>
            <td class="px-3" @if ($order->status->name == "Returned") colspan="2" @endif>{{ __('names.total') }}</td>
            <td class="px-3">{{ $orderItemCountSum }}</td>
            <td class="px-3">{{ number_format($order->sum, 2) }} €</td>
        </tr>
    </tfoot>
</table>
