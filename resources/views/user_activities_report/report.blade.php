<table>
    <thead>
    <tr>
        <th style="min-width: 60px">{{__('table.activityId')}}</th>
        <th style="min-width: 100px">{{__('table.user')}}</th>
        <th style="min-width: 120px">{{__('table.email')}}</th>
        <th style="min-width: 100px">{{__('table.userType')}}</th>
        <th style="min-width: 200px">{{__('table.activity')}}</th>
        <th style="min-width: 150px">{{__('table.created_at')}}</th>
    </tr>
    </thead>
    @forelse ($userActivities as $userActivity)
        <tbody>
        <tr>
            <td style="margin-left: 10px">{{ $userActivity->id ?? '-' }}</td>
            <td>{{ $userActivity->user->name ?? '-' }}</td>
            <td>{{ $userActivity->user->email ?? '-' }}</td>
            <td>{{ $userActivity->user->role->name ?? '-' }}</td>
            <td>{{ $userActivity->activity ?? '-' }}</td>
            <td>{{ $userActivity->created_at ? $userActivity->created_at->format('Y-m-d') : '-' }}</td>
        </tr>
        </tbody>
    @empty
        <tr>
            <td colspan="6" class="text-muted py-3">{{ __('table.emptyTable') }}</td>
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
