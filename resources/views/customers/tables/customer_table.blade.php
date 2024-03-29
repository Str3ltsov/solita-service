<table class="table table-striped my-3" id="categories">
    <thead style="background: #e7e7e7;">
    <tr>
        <th class="px-3">{{ __('table.id') }}</th>
        <th class="px-3">{{ __('table.userName') }}</th>
        <th class="px-3">{{ __('table.email') }}</th>
        <th class="px-3">{{ __('table.userType') }}</th>
        <th class="px-3">{{ __('table.status') }}</th>
        <th class="px-3">{{ __('table.created_at') }}</th>
        <th class="px-3">{{ __('table.updated_at') }}</th>
        <th class="px-3">{{ __('table.actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($customers as $customer)
        <tr>
            <td class="px-3">{{ $customer->id }}</td>
            <td class="px-3">{{ $customer->name }}</td>
            <td class="px-3"><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></td>
            <td class="px-3">
                @if ($customer->type == '1')
                    {{ __('table.admin') }}
                @elseif ($customer->type == '2')
                    {{ __('table.specialist') }}
                @elseif ($customer->type == '3')
                    {{ __('table.employee') }}
                @else
                    {{ __('table.user') }}
                @endif
            </td>
            <td class="px-3">
                @if ($customer->status->name == 'Registered')
                    {{ __('names.registered') }}
                @elseif ($customer->status->name == 'Approved')
                    {{ __('names.approved') }}
                @elseif ($customer->status->name == 'Blocked')
                    {{ __('names.blocked') }}
                @endif
            </td>
            <td class="px-3">{{ $customer->created_at }}</td>
            <td class="px-3">{{ $customer->updated_at }}</td>
            <td class="px-3">
                <div class='btn-group w-100 d-flex justify-content-between align-items-center'>
                    <a href="{{ route('customers.show', [$customer->id]) }}"
                       class='btn btn-primary orders-returns-clear-button px-0'>
                        <i class="far fa-eye fs-5 mx-2"></i>
                    </a>
                    <a href="{{ route('customers.edit', [$customer->id]) }}"
                       class='btn btn-primary orders-returns-clear-button px-0'>
                        <i class="fa-solid fa-pen-to-square fs-5 mx-2"></i>
                    </a>
                    {!! Form::open(['route' => ['customers.destroy', $customer->id], 'method' => 'delete']) !!}
                    <button type="submit" class='btn btn-primary orders-returns-clear-button px-0'
                            onclick="return confirm('{{ __('names.areYouSureDeleteUser') }}')">
                        <i class="fa-solid fa-trash-can fs-5 mx-2"></i>
                    </button>
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-muted text-center">{{ __('names.noUsers') }}</td>
        </tr>
    @endforelse
    </tbody>
</table>
