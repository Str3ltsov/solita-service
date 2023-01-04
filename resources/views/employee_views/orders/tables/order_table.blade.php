<table class="table table-striped table-bordered my-3" id="categories">
    <thead style="background: #e7e7e7;">
        <tr>
            <th class="text-center px-3">#</th>
            <th class="px-3">{{ __('table.orderId') }}</th>
            <th class="px-3">{{ __('table.user') }}</th>
            <th class="px-3">{{ __('table.specialist') }}</th>
            <th class="px-3">{{ __('table.status') }}</th>
            <th class="px-3">{{ __('table.priority') }}</th>
            <th class="px-3">{{ __('table.deliveryTime') }}</th>
            <th class="px-3">{{ __('table.sum') }}</th>
            <th class="px-3">{{ __('table.totalHours') }}</th>
            <th class="px-3">{{ __('table.completeHours') }}</th>
            <th class="px-3">{{ __('table.created_at') }}</th>
{{--            <th class="px-3">{{ __('table.updated_at') }}</th>--}}
            <th class="px-3"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr>
                <td class="text-center px-3">{{ $loop->index + 1 }}</td>
                <td class="px-3">{{ $order->order_id }}</td>
                <td class="px-3">{{ $order->user->name }}</td>
                <td class="px-3">{{ $order->specialist->name }}</td>
                <td class="px-3">
                    <span class="d-none">
                        {{ $order->status->id }}
                    </span>
                    <span>
                        {{ $order->status->name }}
                    </span>
                </td>
                <td class="px-3">
                    <span class="d-none">
                        {{ $order->priority->id }}
                    </span>
                    <span>
                        {{ $order->priority->name }}
                    </span>
                </td>
                <td class="px-3">{{ $order->delivery_time.' '.__('names.days') }}</td>
                <td class="px-3">{{ number_format($order->sum, 2) }} €</td>
                <td class="px-3">{{ $order->total_hours }}</td>
                <td class="px-3">{{ $order->complete_hours }}</td>
                <td class="px-3">{{ $order->created_at->format('Y-m-d H:m') }}</td>
{{--                <td class="px-3">{{ $order->updated_at->format('Y-m-d H:m') }}</td>--}}
                <td class="px-3">
                    <div class='btn-group w-100 d-flex justify-content-center align-items-center'>
                        <a href="{{ route('employeeOrderDetails', [$order->id]) }}"
                           class='btn btn-primary orders-returns-primary-button'>
                            <i class="far fa-eye me-1"></i>
                            {{ __('buttons.details') }}
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-muted text-center">{{ __('names.noOrders') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
