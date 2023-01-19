<table class="table table-striped table-bordered my-3" id="categories">
    <thead style="background: #e7e7e7;">
        <tr>
            <th class="text-center px-3">#</th>
            <th class="px-3">{{ __('table.user') }}</th>
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
        @forelse($orderUsers as $orderUser)
            @if ($orderUser->order->status->id == 4)
                <tr>
                    <td class="text-center px-3">{{ $loop->index + 1 }}</td>
                    <td class="px-3">{{ $orderUser->order->user->name }}</td>
                    <td class="px-3">
                        <span class="d-none">
                            {{ $orderUser->order->status->id }}
                        </span>
                        <span>
                            {{ $orderUser->order->status->name }}
                        </span>
                    </td>
                    <td class="px-3">
                        <span class="d-none">
                            {{ $orderUser->order->priority->id }}
                        </span>
                        <span>
                            {{ $orderUser->order->priority->name }}
                        </span>
                    </td>
                    <td class="px-3">€{{ number_format($orderUser->order->budget, 2) }}</td>
                    <td class="px-3">{{ $orderUser->order->total_hours.' '.__('table.hour') }}</td>
                    <td class="px-3">
                        {{ $orderUser->order->complete_hours ? $orderUser->order->complete_hours.' '.__('table.hour') : '-' }}
                    </td>
                    <td class="ps-3 text-start">
                        {{ $orderUser->order->start_date ? $orderUser->order->start_date->format('Y-m-d') : '-' }}
                    </td>
                    <td class="ps-3 text-start">
                        {{ $orderUser->order->end_date ? $orderUser->order->end_date->format('Y-m-d') : '-' }}
                    </td>
                    <td class="px-3">
                        <div class='btn-group w-100 d-flex justify-content-between align-items-center'>
                            <a href="{{ route('specialistOrderDetails', [$orderUser->order->id]) }}"
                               class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'>
                                <i class="far fa-eye fs-5"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endif
        @empty
            <tr>
                <td colspan="10" class="text-muted text-center">{{ __('names.noOrders') }}</td>
            </tr>
        @endforelse
        @if ($orderUser->order->status->id != 4)
            <tr>
                <td colspan="10" class="text-muted text-center">{{ __('names.noOrders') }}</td>
            </tr>
        @endif
    </tbody>
</table>
