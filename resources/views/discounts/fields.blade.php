@foreach (config('translatable.locales') as $locale)
    <div class="form-group col-sm-6">
        {!! Form::label("name_$locale", ''.__('table.name').' '.$locale.':') !!}
        {!! Form::text("name_$locale", ( isset($discount) && isset($discount->translate($locale)->name) ? $discount->translate($locale)->name : null ) , ['class' => 'form-control']) !!}
    </div>

    <!-- Description Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label("description_$locale", ''.__('table.description').' '.$locale.':') !!}
        {!! Form::textarea("description_$locale",  ( isset($discount) && isset($discount->translate($locale)->description) ? $discount->translate($locale)->description : null ), ['class' => 'form-control']) !!}
    </div>
@endforeach
<!-- Proc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('proc', ''.__('table.proc').':') !!}
    {!! Form::number('proc', null, ['class' => 'form-control']) !!}
</div>
