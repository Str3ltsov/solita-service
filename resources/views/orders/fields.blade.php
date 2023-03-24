<!-- Name Field -->
<div class="form-group col-12">
    {!! Form::label('name',  __('table.name').':') !!}
    {!! Form::text('name', $order->name ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-12">
    {!! Form::label('description',  __('table.description').':') !!}
    {!! Form::textarea('description', $order->name ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Budget Field -->
<div class="form-group col-md-4 col-4">
    {!! Form::label('budget',  __('table.budget').':') !!}
    {!! Form::number('budget', $order->budget ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Total Hours Field -->
<div class="form-group col-md-4 col-4">
    {!! Form::label('total_hours',  __('table.totalHours').':') !!}
    {!! Form::number('total_hours', $order->total_hours ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Complete Hours Field -->
<div class="form-group col-md-4 col-4">
    {!! Form::label('complete_hours',  __('table.completeHours').':') !!}
    {!! Form::number('complete_hours', $order->complete_hours ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Start Date Field -->
<div class="form-group col-md-6 col-6">
    {!! Form::label('start_date', __('table.startDate')) !!}
    {!! Form::date('start_date', $order->start_date ?? null, ['min' => now()->format('Y-m-d'),'class' => 'form-control']) !!}
</div>

<!-- End Date Field -->
<div class="form-group col-md-6 col-6">
    {!! Form::label('end_date', __('table.endDate')) !!}
    {!! Form::date('end_date', $order->end_date ?? null, ['min' => now()->format('Y-m-d'),'class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-md-3 col-12">
    {!! Form::label('user_id',  __('table.userId').':') !!}
    {!! Form::select('user_id', $users_list, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Employee Id Field -->
<div class="form-group col-md-3 col-12">
    {!! Form::label('employee_id',  __('table.employee').':') !!}
    {!! Form::select('employee_id', $employee_list, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Status Id Field -->
<div class="form-group col-md-3 col-12">
    {!! Form::label('status_id',  __('table.status').':') !!}
    {!! Form::select('status_id', $statuses_list, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Priority Id Field -->
<div class="form-group col-md-3 col-12">
    {!! Form::label('priority_id',  __('table.priority').':') !!}
    {!! Form::select('priority_id', $priority_list, null, ['class' => 'form-control custom-select']) !!}
</div>
