<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('table.name').':') !!}
    <p>{{ $promotion->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description',  __('table.description').':') !!}
    <p>{{ $promotion->description }}</p>
</div>

<!-- Start Field -->
<div class="col-sm-12">
    {!! Form::label('start',  __('table.start').':') !!}
    <p>{{ $promotion->start }}</p>
</div>

<!-- Finish Field -->
<div class="col-sm-12">
    {!! Form::label('finish',  __('table.finish').':') !!}
    <p>{{ $promotion->finish }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at',  __('table.created_at').':') !!}
    <p>{{ $promotion->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at',  __('table.updated_at').':') !!}
    <p>{{ $promotion->updated_at }}</p>
</div>

