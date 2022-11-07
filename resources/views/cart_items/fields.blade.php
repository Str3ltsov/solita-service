<!-- Cart Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cart_id', __('table.cartId').':') !!}
    {!! Form::select('cart_id', $carts_list, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', __('table.product').':') !!}
    {!! Form::select('product_id', $product_list, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Price Current Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price_current', __('table.priceCurrent').':') !!}
    {!! Form::number('price_current', null, ['class' => 'form-control','min' => 5]) !!}
</div>


<!-- Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('count', __('table.count').':') !!}
    {!! Form::number('count', null, ['class' => 'form-control','min' => 1]) !!}
</div>
