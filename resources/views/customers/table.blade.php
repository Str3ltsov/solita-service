<div class="table table-responsive">
    <table class="table" id="categories">
        <thead>
        <tr>
            <th>{{__('table.userName')}}</th>
            <th>{{__('table.email')}}</th>
            <th>{{__('table.userType')}}</th>
            <th>{{__('table.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>

                <td>{{$customer->name}}</td>
                <td>{{$customer->email}}</td>
                @if ($customer->type == '1')
                    <td>{{__('table.admin')}}</td>
                @elseif ($customer->type == '2')
                    <td>{{__('table.specialist')}}</td>
                @elseif ($customer->type == '3')
                    <td>{{__('table.employee')}}</td>
                @else
                    <td>{{__('table.user')}}</td>
                @endif
                <td width="120">
                    {!! Form::open(['route' => ['customers.destroy', $customer->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('customers.show', [$customer->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('customers.edit', [$customer->id]) }}"
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
