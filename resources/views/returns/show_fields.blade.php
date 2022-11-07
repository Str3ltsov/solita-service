<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', __('table.user').':') !!}
    <p>[{{ $returns->user_id }}] {{ $returns->user->name }}</p>
</div>

<!-- Admin Id Field -->
<div class="col-sm-12">
    {!! Form::label('admin_id', __('table.admin').':') !!}
    <p>[{{ $returns->admin_id }}] {{ $returns->admin->name }}</p>
</div>

<!-- Order Id Field -->
<div class="col-sm-12">
    {!! Form::label('order_id', __('table.orderId').':') !!}
    <p>{{ $returns->order_id }}</p>
</div>

<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', __('table.code').':') !!}
    <p>{{ $returns->code }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('table.description').':') !!}
    <p>{{ $returns->description }}</p>
</div>

<!-- Status Id Field -->
<div class="col-sm-12">
    {!! Form::label('status_id', __('table.status').':') !!}
    <p>{{ $returns->status->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('table.created_at').':') !!}
    <p>{{ $returns->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('table.updated_at').':') !!}
    <p>{{ $returns->updated_at }}</p>
</div>

