<div class="table-responsive">
    <table class="table" id="returnItems-table">
        <thead>
        <tr>
            <th>{{__('table.user')}}</th>
            <th>{{__('table.productName')}}</th>
            <th>{{__('table.priceCurrent')}}</th>
            <th>{{__('table.count')}}</th>
            <th colspan="3">{{__('table.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($returnItems as $returnItem)
            <tr>
                {{--<td>{{ $returnItem->order_id }}</td>--}}
                <td>{{ $returnItem->user->name }}</td>
                {{--<td>{{ $returnItem->return_id }}</td>--}}
                <td>{{ $returnItem->product->name }}</td>
                <td>{{ $returnItem->price_current }}</td>
                <td>{{ $returnItem->count }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['returnItems.destroy', $returnItem->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('returnItems.show', [$returnItem->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('returnItems.edit', [$returnItem->id]) }}"
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
