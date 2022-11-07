<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('table.name').':') !!}
    <p>{{ $product->name }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price',  __('table.price').':') !!}
    <p>{{ $product->price }}</p>
</div>

<!-- Count Field -->
<div class="col-sm-12">
    {!! Form::label('count',  __('table.count').':') !!}
    <p>{{ $product->count }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description',  __('table.description').':') !!}
    <p>{{ $product->description }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image',  __('table.image').':') !!}
    <p>{{ $product->image }}</p>
</div>

<!-- Video Field -->
<div class="col-sm-12">
    {!! Form::label('video',  __('table.video').':') !!}
    <p>{{ $product->video }}</p>
</div>

<!-- Visible Field -->
<div class="col-sm-12">
    {!! Form::label('visible',  __('table.visible').':') !!}
    <p>{{ $product->visible }}</p>
</div>

<!-- Promotion Id Field -->
<div class="col-sm-12">
    {!! Form::label('promotion_id',__('table.promotionId').':') !!}
    <p>{{ $product->promotion_id }}</p>
</div>

<!-- Discount Id Field -->
<div class="col-sm-12">
    {!! Form::label('discount_id', __('table.discountId').':') !!}
    <p>{{ $product->discount_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('table.created_at').':') !!}
    <p>{{ $product->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('table.updated_at').':') !!}
    <p>{{ $product->updated_at }}</p>
</div>

