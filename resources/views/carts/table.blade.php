<div class="table-responsive">
    <table class="table" id="carts-table">
        <thead>
        <tr>
            <th>{{__('table.user')}}</th>
            <th>{{__('table.code')}}</th>
            <th>{{__('table.status')}}</th>
            <th>{{__('table.admin')}}</th>
            <th colspan="3">{{__('table.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($carts as $cart)
            <tr>
                <td>{{ $cart->user->name }}</td>
                <td>{{ $cart->code }}</td>
                <td>{{ $cart->status->name }}</td>
                <td>{{ $cart->admin->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['carts.destroy', $cart->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('carts.show', [$cart->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('carts.edit', [$cart->id]) }}"
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
