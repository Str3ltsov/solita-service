<table class="table table-striped my-3" id="categories">
    <thead style="background: #e7e7e7;">
        <tr>
            <th class="text-center px-3">{{ __('table.id') }}</th>
            <th class="px-3">{{ __('table.name') }}</th>
            <th class="px-3">{{ __('names.client') }}</th>
            <th class="px-3">{{ __('table.status') }}</th>
            <th class="px-3">{{ __('table.priority') }}</th>
            <th class="px-3">{{ __('table.budget') }}</th>
            <th class="px-3">{{ __('table.totalHours') }}</th>
            <th class="px-3">{{ __('table.completeHours') }}</th>
            <th class="px-3">{{ __('table.startDate') }}</th>
            <th class="px-3">{{ __('table.endDate') }}</th>
            <th class="px-3"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr>
                <td class="text-center px-3">{{ $order->id }}</td>
                <td class="px-3">{{ $order->name }}</td>
                <td class="px-3">{{ $order->user->name }}</td>
{{--                <td class="px-3">{{ $order->specialist->name }}</td>--}}
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
                <td class="px-3">€{{ number_format($order->budget, 2) }}</td>
                <td class="px-3">{{ $order->total_hours.' '.__('table.hour') }}</td>
                <td class="px-3">
                    {{ $order->complete_hours ? $order->complete_hours.' '.__('table.hour') : '-' }}
                </td>
                <td class="ps-3 text-start">
                    {{ $order->start_date ? $order->start_date->format('Y-m-d') : '-' }}
                </td>
                <td class="ps-3 text-start">
                    {{ $order->end_date ? $order->end_date->format('Y-m-d') : '-' }}
                </td>
                <td class="px-3">
                    <div class='btn-group w-100 d-flex justify-content-between align-items-center'>
                        <a href="{{ route('employeeOrderDetails', [$order->id]) }}"
                           class='btn btn-primary orders-returns-clear-button px-0'>
                            <i class="far fa-eye fs-5"></i>
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
