<table class="table table-striped table-bordered my-3" id="categories">
    <thead style="background: #e7e7e7;">
    <tr>
        <th class="text-center px-3">{{ __('table.id') }}</th>
        <th class="px-3 w-50">{{ __('table.name') }}</th>
        <th class="px-3">{{ __('table.startDate') }}</th>
        <th class="px-3">{{ __('table.endDate') }}</th>
        <th class="px-3"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($orderStatuses as $orderStatus)
        <tr>
            <td class="text-center px-3">{{ $orderStatus->id }}</td>
            <td class="px-3 w-50">{{ $orderStatus->name }}</td>
            <td class="ps-3 text-start">
                {{ $orderStatus->start_date ? $orderStatus->start_date->format('Y-m-d') : '-' }}
            </td>
            <td class="ps-3 text-start">
                {{ $orderStatus->end_date ? $orderStatus->end_date->format('Y-m-d') : '-' }}
            </td>
            <td class="px-3">
                <div class='btn-group w-100 d-flex justify-content-between align-items-center'>
{{--                    <a href="{{ route('orders.show', [$order->id]) }}"--}}
{{--                       class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'>--}}
{{--                        <i class="far fa-eye fs-5 mx-2"></i>--}}
{{--                    </a>--}}
                    <a href="{{ route('orderStatuses.edit', [$orderStatus->id]) }}"
                       class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'>
                        <i class="fa-solid fa-pen-to-square fs-5 mx-2"></i>
                    </a>
                    {!! Form::open(['route' => ['orderStatuses.destroy', $orderStatus->id], 'method' => 'delete']) !!}
                    <button type="submit" class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'
                            onclick="return confirm('{{ __('names.areYouSureDeleteOrderStatus') }}')">
                        <i class="fa-solid fa-trash-can fs-5 mx-2"></i>
                    </button>
                    {!! Form::close() !!}
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



