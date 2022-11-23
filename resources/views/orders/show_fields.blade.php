<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('table.user').':') !!}
    <p>[{{ $order->user_id }}] {{ $order->user->name }}</p>
</div>

<!-- Specialist Id Field -->
<div class="col-sm-12">
    {!! Form::label('specialist_id', __('table.specialist').':') !!}
    <p>[{{ $order->specialist_id }}] {{ $order->specialist->name }}</p>
</div>

<!-- Employee Id Field -->
<div class="col-sm-12">
    {!! Form::label('employee_id', __('table.employee').':') !!}
    <p>[{{ $order->employee_id }}] {{ $order->employee->name }}</p>
</div>

<!-- Status Id Field -->
<div class="col-sm-12">
    {!! Form::label('status_id',  __('table.status').':') !!}
    <p>{{ $order->status->name }}</p>
</div>

<!-- Priority Id Field -->
<div class="col-sm-12">
    {!! Form::label('priority_id', __('table.priority').':') !!}
    <p>{{ $order->priority->name }}</p>
</div>

<!-- Delivery Time Field -->
<div class="col-sm-12">
    {!! Form::label('delivery_time',  __('table.deliveryTime').':') !!}
    <p>{{ $order->delivery_time }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at',  __('table.created_at').':') !!}
    <p>{{ $order->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at',  __('table.updated_at').':') !!}
    <p>{{ $order->updated_at }}</p>
</div>

