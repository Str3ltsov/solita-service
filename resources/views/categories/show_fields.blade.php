<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('table.name')) !!}
    <p>{{ $category->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('table.description')) !!}
    <p>{{ $category->description }}</p>
</div>

<!-- Parent Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_id', __('table.parentId')) !!}
    <p>{{ $category->parent_id }}</p>
</div>

<!-- Visible Field -->
<div class="col-sm-12">
    {!! Form::label('visible', __('table.visible')) !!}
    <p>{{ $category->visible }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('table.created_at')) !!}
    <p>{{ $category->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('table.updated_at')) !!}
    <p>{{ $category->updated_at }}</p>
</div>

