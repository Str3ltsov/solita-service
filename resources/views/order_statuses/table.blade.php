<div class="table-responsive">
    <table class="table" id="orderStatuses-table">
        <thead>
        <tr>
            <th>{{__('table.name')}}</th>
            <th colspan="3">{{__('table.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orderStatuses as $orderStatus)
            <tr>
                <td>{{ $orderStatus->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['orderStatuses.destroy', $orderStatus->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('orderStatuses.show', [$orderStatus->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('orderStatuses.edit', [$orderStatus->id]) }}"
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
