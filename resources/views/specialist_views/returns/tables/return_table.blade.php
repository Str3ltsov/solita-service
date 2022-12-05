<table class="table table-striped table-bordered my-3" id="categories">
    <thead style="background: #e7e7e7;">
        <tr>
            <th class="text-center px-3">#</th>
            <th class="px-3">{{ __('table.orderId') }}</th>
            <th class="px-3">{{ __('table.user') }}</th>
            <th class="px-3">{{ __('table.specialist') }}</th>
            <th class="px-3">{{ __('table.code') }}</th>
{{--            <th class="px-3">{{ __('table.description') }}</th>--}}
            <th class="px-3">{{ __('table.status') }}</th>
            <th class="px-3">{{ __('table.created_at') }}</th>
{{--            <th class="px-3">{{ __('table.updated_at') }}</th>--}}
            <th class="px-3"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($returns as $return)
            <tr>
                <td class="text-center px-3">{{ $loop->index + 1 }}</td>
                <td class="px-3">{{ $return->order_id }}</td>
                <td class="px-3">{{ $return->user->name }}</td>
                <td class="px-3">{{ $return->specialist->name }}</td>
                <td class="px-3">{{ $return->code }}</td>
{{--                <td class="px-3">{{ $return->description }}</td>--}}
                <td class="px-3">
                    <span class="d-none">
                        {{ $return->status->id }}
                    </span>
                    <span>
                        {{ $return->status->name }}
                    </span>
                </td>
                <td class="px-3">{{ $return->created_at->format('Y-m-d H:m') }}</td>
{{--                <td class="px-3">{{ $order->updated_at->format('Y-m-d H:m') }}</td>--}}
                <td class="px-3">
                    <div class='btn-group w-100 d-flex justify-content-center align-items-center'>
                        <a href="{{ route('employeeReturnDetails', [$return->id]) }}"
                           class='btn btn-primary orders-returns-primary-button'>
                            <i class="far fa-eye me-1"></i>
                            {{ __('buttons.details') }}
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-muted text-center">{{ __('names.noReturns') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
