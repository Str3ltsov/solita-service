<div class="table-responsive">
    <table class="table" id="orderItems-table">
        <thead>
        <tr>
            <th>{{__('table.orderId')}}</th>
            <th>{{__('table.product')}}</th>
            <th>{{__('table.price')}}</th>
            <th>{{__('table.count')}}</th>
            <th colspan="3">{{__('table.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orderItems as $orderItem)
            <tr>
                <td>{{ $orderItem->order_id }}</td>
                <td>{{ $orderItem->product->name }}</td>
                <td>{{ $orderItem->price_current }}</td>
                <td>{{ $orderItem->count }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['orderItems.destroy', $orderItem->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('orderItems.show', [$orderItem->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('orderItems.edit', [$orderItem->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
