<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', __('table.orderId').':') !!}
    {!! Form::select('order_id', $orders_list, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', __('table.productId').':') !!}
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
