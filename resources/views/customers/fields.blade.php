<div class="form-group col-12 col-md-6">
    {!! Form::label('name', __('forms.name').':' )!!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-12 col-md-6">
    {!! Form::label('email', __('forms.email').':' )!!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-12 col-md-6">
    {!! Form::label('type',  __('table.userType').':') !!}
    {!! Form::select('type', $roles_list, null, ['class' => 'form-control custom-select']) !!}
</div>

<div class="form-group col-12 col-md-6">
    {!! Form::label('status_id',  __('table.status').':') !!}
    {!! Form::select('status_id', $status_list, null, ['class' => 'form-control custom-select']) !!}
</div>

<div class="form-group col-12 col-md-6">
    {!! Form::label('street', __('forms.street').':') !!}
    {!! Form::text('street', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-6 col-md-3">
    {!! Form::label('house_flat', __('forms.house_flat').':') !!}
    {!! Form::text('house_flat', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-6 col-md-3">
    {!! Form::label('post_index', __('forms.post_index').':') !!}
    {!! Form::text('post_index', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-12 col-md-6">
    {!! Form::label('city', __('forms.city').':') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-12 col-md-6">
    {!! Form::label('phone_number', __('forms.phone_number').':') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-12 col-md-6">
    {!! Form::label('new_password', __('forms.new_password').':') !!}
    {!! Form::password('new_password', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-12 col-md-6">
    {!! Form::label('new_password_confirmation', __('forms.confirm_password').':') !!}
    {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
</div>
@if ($customer->type == '3')
    <div class="form-group col-12 col-md-6">
        {!! Form::label('work_info', __('forms.work_info').':') !!}
        {!! Form::text('work_info', null, ['class' => 'form-control']) !!}
    </div>
@endif
@if ($customer->type == '2')
    <div class="form-group col-12 col-md-6">
        {!! Form::label('hourly_price', __('forms.hourly_price').':') !!}
        {!! Form::text('hourly_price', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-12 col-md-6">
        {!! Form::label('experience', __('table.workExperience'). ' (' . __('table.year') . '):') !!}
        {!! Form::select('experience', $exp_list, null, ['class' => 'form-control custom-select']) !!}
    </div>
    <div class="form-group col-12">
        {!! Form::label('work_info', __('forms.work_info').':') !!}
        {!! Form::text('work_info', null, ['class' => 'form-control']) !!}
    </div>
@endif
