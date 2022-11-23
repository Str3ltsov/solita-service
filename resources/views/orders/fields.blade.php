<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id',  __('table.userId').':') !!}
    {!! Form::select('user_id', $users_list, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Specialist Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('specialist_id',  __('table.specialist').':') !!}
    {!! Form::select('specialist_id', $specialist_list, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Employee Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee_id',  __('table.employee').':') !!}
    {!! Form::select('employee_id', $employee_list, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_id',  __('table.status').':') !!}
    {!! Form::select('status_id', $statuses_list, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Priority Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('priority_id',  __('table.priority').':') !!}
    {!! Form::select('priority_id', $priority_list, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Priority Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_time',  __('table.deliveryTime').':') !!}
    {!! Form::number('delivery_time', $order->delivery_time ?? null, ['class' => 'form-control']) !!}
</div>
