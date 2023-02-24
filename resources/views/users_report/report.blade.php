<table>
    <thead>
    <tr>
        <th style="min-width: 60px">{{__('table.id')}}</th>
        <th style="min-width: 100px">{{__('table.name')}}</th>
        <th style="min-width: 120px">{{__('table.email')}}</th>
        <th style="min-width: 100px">{{__('forms.phone_number')}}</th>
        <th style="min-width: 100px">{{__('forms.street')}}</th>
        <th style="min-width: 60px">{{__('forms.house_flat')}}</th>
        <th style="min-width: 100px">{{__('forms.post_index')}}</th>
        <th style="min-width: 100px">{{__('forms.city')}}</th>
        <th style="min-width: 80px">{{__('table.userType')}}</th>
        <th style="min-width: 80px">{{__('table.status')}}</th>
{{--        <th style="min-width: 300px">{{__('forms.work_info')}}</th>--}}
{{--        <th style="min-width: 60px">{{__('forms.hourly_price')}}</th>--}}
{{--        <th style="min-width: 100px">{{__('table.workExperience')}}</th>--}}
        <th style="min-width: 160px">{{__('table.created_at')}}</th>
    </tr>
    </thead>
    @forelse ($users as $user)
        <tbody>
            <tr>
                <td style="margin-left: 10px">{{ $user->id ?? '-' }}</td>
                <td>{{ $user->name ?? '-' }}</td>
                <td>{{ $user->email ?? '-' }}</td>
                <td>{{ $user->phone_number ?? '-'}}</td>
                <td>{{ $user->street ?? '-'}}</td>
                <td>{{ $user->house_flat ?? '-'}}</td>
                <td>{{ $user->post_index ?? '-'}}</td>
                <td>{{ $user->city ?? '-'}}</td>
                <td>{{ $user->role->name ?? '-' }}</td>
                <td>{{ $user->status->name ?? '-' }}</td>
{{--                <td>{{ $user->work_info ?? '-' }}</td>--}}
{{--                <td>{{ $user->hourly_price ? '€'.$user->hourly_price : '-' }}</td>--}}
{{--                <td>{{ $user->experience ? $user->experience->name.' '.__('names.years') : '-' }}</td>--}}
                <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : '-' }}</td>
            </tr>
        </tbody>
    @empty
        <tr>
            <td colspan="11" class="text-muted py-3">{{ __('table.emptyTable') }}</td>
        </tr>
    @endforelse
</table>

<style>
    .table > :not(caption) > * > * {
        padding: 0;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        font-size: 1rem;
    }

    table tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35em;
    }

    table th,
    table td {
        padding: .5rem 1rem
    }

    table thead tr:nth-child(1) {
        background-color: #e3e3e3;
    }
</style>
