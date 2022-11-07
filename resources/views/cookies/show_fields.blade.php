<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('table.name').':') !!}
    <p>{{$cookie->name}}</p>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description',  __('table.description').':') !!}
    <p>{{$cookie->description}}</p>
</div>

<!-- Is Cookie Mandatory Field -->
<div class="form-group col-sm-12">
    {!! Form::label('isMandatory',  __('table.mandatoryStatus').':') !!}
    <p>{{$cookie->isMandatory}}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('table.created_at').':') !!}
    <p>{{ $cookie->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at',  __('table.updated_at').':') !!}
    <p>{{ $cookie->updated_at }}</p>
</div>

