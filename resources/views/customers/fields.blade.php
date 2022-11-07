<div class="form-group col-sm-6">
    {!! Form::label('code', __('forms.name').':' )!!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('code', __('forms.email').':' )!!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('street', __('forms.street').':') !!}
    {!! Form::text('street', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('house_flat', __('forms.house_flat').':') !!}
    {!! Form::text('house_flat', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('post_index', __('forms.post_index').':') !!}
    {!! Form::text('post_index', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('city', __('forms.city').':') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('phone_number', __('forms.phone_number').':') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('new_password', __('forms.new_password').':') !!}
    {!! Form::password('new_password', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('new_password_confirmation', __('forms.confirm_password').':') !!}
    {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
</div>
