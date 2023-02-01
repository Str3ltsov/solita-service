<table class="table table-striped table-bordered mb-3" id="categories">
    <thead style="background: #e7e7e7;">
        <tr>
            <th class="text-center" width="10">#</th>
            <th class="px-3">{{ __('table.title') }}</th>
            <th class="px-3">{{ __('table.status') }}</th>
{{--            <th class="px-3">{{ __('table.deliveryTime') }}</th>--}}
            <th class="px-3">{{ __('table.budget') }}</th>
            <th class="px-3">{{ __('table.totalHours') }}</th>
            <th class="px-3">{{ __('table.completeHours') }}</th>
            <th class="px-3">{{ __('table.startDate') }}</th>
            <th class="px-3">{{ __('table.endDate') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $item)
            <tr>
                <td class="ps-3 text-center">{{ $loop->index + 1 }}</td>
                <td class="ps-3 text-start">{{ $item->name }}</td>
                <td class="ps-3 text-start">{{ $item->status->name }}</td>
{{--                <td class="ps-3 text-start">{{ __($item->delivery_time).' '.__('names.days') }}</td>--}}
                <td class="ps-3 text-start">€{{ number_format($item->budget, 2) ?? '-' }}</td>
                <td class="px-3">{{ $item->total_hours.' '.__('table.hour') }}</td>
                <td class="px-3">
                    {{ $item->complete_hours ? $item->complete_hours.' '.__('table.hour') : '-' }}
                </td>
                <td class="ps-3 text-start">
                    {{ $item->start_date ? $item->start_date->format('Y-m-d') : '-' }}
                </td>
                <td class="ps-3 text-start">
                    {{ $item->end_date ? $item->end_date->format('Y-m-d') : '-' }}
                </td>
                <td class="text-start">
                    <div class='btn-group w-100 d-flex justify-content-between align-items-center'>
                        <a href="{{ route('vieworder', [$prefix, $item->id]) }}"
                           class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'>
                            <i class="far fa-eye fs-5"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="ps-3">{{__('names.noOrders')}}</td>
            </tr>
        @endforelse
    </tbody>
</table>
