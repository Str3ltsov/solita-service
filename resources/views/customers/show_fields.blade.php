<h6 class="mt-2">{{ __('menu.profile') }}</h6>

<div class="col-12 col-md-6">
    {!! Form::label('name', __('forms.name')).":" !!}
    <p>{{ $customer->name ?? '-' }}</p>
</div>

<div class="col-12 col-md-6">
    {!! Form::label('email', __('forms.email')).":" !!}
    <p>{{ $customer->email ?? '-' }}</p>
</div>

<div class="col-12 col-md-6">
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

<div class="col-12 col-md-6">
    {!! Form::label('status',  __('table.status')).":" !!}
    @if ($customer->status->name == 'Registered')
        <p>{{ __('names.registered') }}</p>
    @elseif ($customer->status->name == 'Approved')
        <p>{{ __('names.approved') }}</p>
    @elseif ($customer->status->name == 'Blocked')
        <p>{{ __('names.blocked') }}</p>
    @endif
</div>

<div class="col-12 col-md-6">
    {!! Form::label('phone_number', __('forms.phone_number')).":" !!}
    <p>{{ $customer->phone_number ?? '-' }}</p>
</div>

<div class="col-12 col-md-6">
    {!! Form::label('street', __('forms.street')).":" !!}
    <p>{{ $customer->street ?? '-' }}</p>
</div>

<div class="col-12 col-md-6">
    {!! Form::label('house_flat', __('forms.house_flat')).":" !!}
    <p>{{ $customer->house_flat ?? '-' }}</p>
</div>

<div class="col-12 col-md-6">
    {!! Form::label('post_index', __('forms.post_index')).":" !!}
    <p>{{ $customer->post_index ?? '-' }}</p>
</div>

<div class="col-12 col-md-6">
    {!! Form::label('city', __('forms.city')).":" !!}
    <p>{{ $customer->city ?? '-'}}</p>
</div>

@if ($customer->type == '2')
    <hr>
    <h6>{{ __('names.specialist') }}</h6>
    <div class="col-12 col-md-6">
        {!! Form::label('work_info',  __('forms.work_info')).":" !!}
        <p>{{ $customer->work_info ?? '-' }}</p>
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('experience',  __('table.workExperience')).":" !!}
        <p>{{ $customer->experience ?  $customer->experience->name.__('table.year') : "" }}</p>

        {!! Form::label('occupation_percentage',  __('table.occupationPercentage')).":" !!}
        <p>{{ $customer->occupation->percentage.'%' ?? '-' }}</p>
    </div>
@elseif ($customer->type == '3')
    <hr>
    <h6>{{ __('names.employee') }}</h6>
    <div class="col-12">
        {!! Form::label('work_info',  __('forms.work_info')).":" !!}
        <p>{{ $customer->work_info ?? '-' }}</p>
    </div>
@endif
