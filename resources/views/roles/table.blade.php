<div class="table-responsive">
    <table class="table" id="orderStatuses-table">
        <thead>
        <tr>
            <th>{{ __('table.typeId') }}</th>
            <th>{{ __('table.typeName') }}</th>
            <th>{{ __('table.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ url('admin/roles/'.$role->id) }}"
                           class="btn btn-default btn-xs">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ url('admin/roles/'.$role->id.'/edit') }}"
                           class="btn btn-default btn-xs">
                            <i class="fas fa-edit"></i>
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
