<div class="col-sm-12">
    {!! Form::label('name', __('forms.name')).":" !!}
    <p>{{ $customer->name }}</p>
</div>
<div class="col-sm-12">
    {!! Form::label('email', __('forms.email')).":" !!}
    <p>{{ $customer->email }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('street', __('forms.street')).":" !!}
    <p>{{ $customer->street }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('house_flat', __('forms.house_flat')).":" !!}
    <p>{{ $customer->house_flat }}</p>
</div>
<div class="col-sm-12">
    {!! Form::label('post_index', __('forms.post_index')).":" !!}
    <p>{{ $customer->post_index }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('city', __('forms.city')).":" !!}
    <p>{{ $customer->city }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('usertype', __('forms.usertype')).":" !!}
    @if ($customer->type == '1')
        <p>{{__('table.admin')}}</p>
    @elseif ($customer->type == '2')
        <p>{{__('table.specialist')}}</p>
    @elseif ($customer->type == '3')
        <p>{{__('table.employee')}}</p>
    @else
        <p>{{__('table.user')}}</p>
    @endif
</div>
<div class="col-sm-12">
    {!! Form::label('created_at',  __('table.created_at')).":" !!}
    <p>{{ $customer->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at',  __('table.updated_at')).":" !!}
    <p>{{ $customer->updated_at }}</p>
</div>
