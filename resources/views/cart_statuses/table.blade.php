<div class="table-responsive">
    <table class="table" id="cartStatuses-table">
        <thead>
        <tr>
            <th>{{__('table.name')}}</th>
            <th colspan="3">{{__('table.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cartStatuses as $cartStatus)
            <tr>
                <td>{{ $cartStatus->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cartStatuses.destroy', $cartStatus->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cartStatuses.show', [$cartStatus->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cartStatuses.edit', [$cartStatus->id]) }}"
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
