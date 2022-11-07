{{--<!-- Name Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('name', 'Name:') !!}--}}
{{--    {!! Form::text('name', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Description Field -->--}}
{{--<div class="form-group col-sm-12 col-lg-12">--}}
{{--    {!! Form::label('description', 'Description:') !!}--}}
{{--    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Name Field -->
@foreach (config('translatable.locales') as $locale)
    <div class="form-group col-sm-6">
        {!! Form::label("name_$locale", ''.__('table.name').' '.$locale.':') !!}
        {!! Form::text("name_$locale", ( isset($product) && isset($product->translate($locale)->name) ? $product->translate($locale)->name : null ) , ['class' => 'form-control']) !!}
    </div>

    <!-- Description Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label("description_$locale", ''.__('table.description').' '.$locale.':') !!}
        {!! Form::textarea("description_$locale",  ( isset($product) && isset($product->translate($locale)->description) ? $product->translate($locale)->description : null ), ['class' => 'form-control']) !!}
    </div>
@endforeach

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price',__('table.price').':') !!}
    {!! Form::number('price', null, ['class' => 'form-control', 'step' => '0.01']) !!}
</div>

<!-- Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('count', __('table.count').':') !!}
    {!! Form::number('count', null, ['class' => 'form-control']) !!}
</div>


<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image',__('table.image').':') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('image', ['class' => 'custom-file-input']) !!}
            {!! Form::label('image', __('buttons.chooseFile'), ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>


<!-- Video Field -->
<div class="form-group col-sm-6">
    {!! Form::label('video', __('table.video').':') !!}
    {!! Form::text('video', null, ['class' => 'form-control']) !!}
</div>

<!-- Visible Field -->
<div class="form-group col-sm-6">
    {!! Form::label('visible', __('table.visible').':') !!}
    {!! Form::select('visible', $visible_list, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Promotion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('promotion_id', __('table.promotionId').':') !!}
    {!! Form::select('promotion_id', $promotions, null, ['class' => 'form-control custom-select', 'placeholder' => '---']) !!}
</div>


<!-- Discount Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('discount_id', __('table.discountId').':') !!}
    {!! Form::select('discount_id', $discounts, null, ['class' => 'form-control custom-select', 'placeholder' => '---']) !!}
</div>


<!-- Discount Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categories', __('table.categories').':') !!}
    {!! Form::select('categories[]', $categories, null, ['class' => 'form-control custom-select', 'multiple'=>'multiple','name'=>'categories[]']) !!}
</div>
