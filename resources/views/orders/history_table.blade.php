<div class="table table-responsive">
    <table class="table table-striped table-bordered my-3" id="ordersHistory-table">
        <thead style="background: #e7e7e7;">
        <tr>
            <th class="ps-3">{{__('table.date')}}</th>
            <th class="ps-3">{{__('table.action')}}</th>
        </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td class="ps-3">{{$log->created_at}}</td>
                    <td class="ps-3">{{$log->activity}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
