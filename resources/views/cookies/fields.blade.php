
<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name',  __('table.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description',  __('table.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<!-- Is Cookie Mandatory Field -->
<div class="form-group col-sm-12">
    {!! Form::label('isMandatory',  __('table.mandatoryStatus').':') !!}
    {!! Form::checkbox('isMandatory',true, true) !!}
</div>
