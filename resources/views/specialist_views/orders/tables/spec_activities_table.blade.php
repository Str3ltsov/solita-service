<div class="table table-responsive">
    <table class="table table-striped table-bordered my-3" id="ordersHistory-table">
        <thead style="background: #e7e7e7;">
        <tr>
            <th class="ps-3">{{ __('table.activity') }}</th>
            <th class="ps-3">{{ __('table.created_at') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($specActivities as $specActivity)
            <tr>
                <td class="ps-3" width="800px">
                    {{ $specActivity->user->name.' '.__('names.specAdded').' '.$specActivity->hours.' '.__('table.hour').' '.__('names.toOrder') }}.
                </td>
                <td class="ps-3">
                    {{ $specActivity->created_at ? $specActivity->created_at->format('Y-m-d') : '-' }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
