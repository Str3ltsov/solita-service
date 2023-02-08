<div class="form-group col-12 mb-2">
    {!! Form::label("name", __('table.title').':') !!}
    {!! Form::text("name", $orderPriority->name ?? null, ['class' => 'form-control']) !!}
</div>
