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
            {!! Form::file('image', ['class' => 'custom-file-input form-control']) !!}
{{--            {!! Form::label('image', __('buttons.chooseFile'), ['class' => 'custom-file-label']) !!}--}}
        </div>
    </div>
</div>


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

<!-- Categories Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categories', __('table.categories').':') !!}
    {!! Form::select('categories[]', $categories, null, ['class' => 'form-control custom-select', 'multiple'=>'multiple','name'=>'categories[]']) !!}
</div>

<!-- Created At Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', __('table.created_at').':') !!}
    {!! Form::date('created_at', isset($product) && $product->created_at->format('Y-m-d') ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Updated At Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', __('table.updated_at').':') !!}
    {!! Form::date('updated_at', isset($product) && $product->updated_at->format('Y-m-d') ?? null, ['class' => 'form-control']) !!}
</div>
