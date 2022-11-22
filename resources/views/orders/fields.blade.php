<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id',  __('table.userId').':') !!}
    {!! Form::select('user_id', $users_list, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Specialist Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('specialist_id',  __('table.specialistId').':') !!}
    {!! Form::select('specialist_id', $specialist_id, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_id',  __('table.statusId').':') !!}
    {!! Form::select('status_id', $statuses_list, null, ['class' => 'form-control custom-select']) !!}
</div>
