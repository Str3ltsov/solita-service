{{--<div class="table-responsive">--}}
{{--    <table class="table" id="orderStatuses-table">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>{{ __('table.typeId') }}</th>--}}
{{--            <th>{{ __('table.typeName') }}</th>--}}
{{--            <th>{{ __('table.action') }}</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($roles as $role)--}}
{{--            <tr>--}}
{{--                <td>{{ $role->id }}</td>--}}
{{--                <td>{{ $role->name }}</td>--}}
{{--                <td>--}}
{{--                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                        <a href="{{ url('admin/roles/'.$role->id) }}"--}}
{{--                           class="btn btn-default btn-xs">--}}
{{--                            <i class="fas fa-eye"></i>--}}
{{--                        </a>--}}
{{--                        <a href="{{ url('admin/roles/'.$role->id.'/edit') }}"--}}
{{--                           class="btn btn-default btn-xs">--}}
{{--                            <i class="fas fa-edit"></i>--}}
{{--                        </a>--}}
{{--                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}

{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--</div>--}}

<table class="table table-striped table-bordered my-3" id="categories">
    <thead style="background: #e7e7e7;">
    <tr>
        {{--        <th class="text-center px-3">#</th>--}}
        <th class="px-3">{{ __('table.id') }}</th>
        <th class="px-3 w-50">{{ __('table.typeName') }}</th>
        <th class="px-3">{{ __('table.created_at') }}</th>
        <th class="px-3">{{ __('table.updated_at') }}</th>
        <th class="px-3"></th>
    </tr>
    </thead>
    <tbody>
    @forelse ($roles as $role)
        <tr>
            {{--            <td class="text-center px-3">{{ $loop->index + 1 }}</td>--}}
            <td class="px-3">{{ $role->id }}</td>
            <td class="px-3 w-50">{{ $role->name }}</td>
            <td class="px-3">{{ $role->created_at }}</td>
            <td class="px-3">{{ $role->updated_at }}</td>
            <td class="px-3">
                <div class='btn-group w-100 d-flex justify-content-between align-items-center'>
                    <a href="{{ route('roles.edit', [$role->id]) }}"
                       class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'>
                        <i class="fa-solid fa-pen-to-square fs-5 mx-2"></i>
                    </a>
                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                    <button type="submit" class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'
                            onclick="return confirm('{{ __('names.areYouSureDeleteRole') }}')">
                        <i class="fa-solid fa-trash-can fs-5 mx-2"></i>
                    </button>
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-muted text-center">{{ __('names.noRoles') }}</td>
        </tr>
    @endforelse
    </tbody>
</table>

