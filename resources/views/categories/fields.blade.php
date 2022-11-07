<!-- Name Field -->
@foreach (config('translatable.locales') as $locale)
    <div class="form-group col-sm-6">
        {!! Form::label("name_$locale", ''.__('table.name').' '.$locale.':') !!}
        {!! Form::text("name_$locale", ( isset($category) && isset($category->translate($locale)->name) ? $category->translate($locale)->name : null ) , ['class' => 'form-control']) !!}
    </div>

    <!-- Description Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label("description_$locale", ''.__('table.description').' '.$locale.':') !!}
        {!! Form::textarea("description_$locale",  ( isset($category) && isset($category->translate($locale)->description) ? $category->translate($locale)->description : null ), ['class' => 'form-control']) !!}
    </div>
@endforeach



<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', __('table.parentId').':') !!}
    {!! Form::select('parent_id', $categories, null, ['class' => 'form-control custom-select', 'placeholder' => '---']) !!}
</div>


<!-- Visible Field -->
<div class="form-group col-sm-12">
    {!! Form::label('visible', __('table.visible').':', ['class' => 'form-check-label']) !!}
    {!! Form::select('visible', $visible_list, null, ['class' => 'form-control custom-select']) !!}
</div>
