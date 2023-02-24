{!! Form::model($user, ['route' => ['userprofilesave', $prefix], 'method' => 'patch', 'class' => 'auth-form-container px-0']) !!}
    <div class="row">
        <input type="hidden" name="type" value="{{ $user->type }}">
        <input type="hidden" name="status_id" value="{{ $user->status_id ?? \App\Models\UserStatus::APPROVED }}">
        <div class="form-group col-md-6 col-sm-12 mb-2">
            {!! Form::label('code', __('forms.name') )!!}
            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-6 col-sm-12 mb-2">
            {!! Form::label('email', __('forms.email')) !!}
            {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-6 col-sm-12 mb-2">
            {!! Form::label('street', __('forms.street')) !!}
            {!! Form::text('street', $user->street, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-3 col-sm-6 mb-2">
            {!! Form::label('house_flat', __('forms.house_flat')) !!}
            {!! Form::text('house_flat', $user->house_flat, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-3 col-sm-6 mb-2">
            {!! Form::label('post_index', __('forms.post_index')) !!}
            {!! Form::text('post_index', $user->post_index, ['class' => 'form-control']) !!}
        </div>
        @if (Auth::user()->type == 2)
            <div class="form-group col-md-6 col-sm-12 mb-2">
                {!! Form::label('city', __('forms.city')) !!}
                {!! Form::text('city', $user->city, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-6 col-sm-12 mb-2">
                {!! Form::label('phone_number', __('forms.phone_number')) !!}
                {!! Form::text('phone_number', $user->phone_number, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-6 col-sm-12 mb-2">
                {!! Form::label('hourly_price', __('forms.hourly_price')).' (€)' !!}
                {!! Form::text('hourly_price', number_format($user->hourly_price, 2), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-6 col-sm-12 mb-2">
                {!! Form::label('experience', __('names.experience')).' ('.__('names.years').')' !!}
                {!! Form::select('experience', $experiences, $user->experience_id, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
            </div>
        @else
            <div class="form-group col-md-6 col-sm-12 mb-2">
                {!! Form::label('city', __('forms.city')) !!}
                {!! Form::text('city', $user->city, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-6 col-sm-12 mb-2">
                {!! Form::label('phone_number', __('forms.phone_number')) !!}
                {!! Form::text('phone_number', $user->phone_number, ['class' => 'form-control']) !!}
            </div>
        @endif
        @if (Auth::user()->type == 2 || Auth::user()->type == 3)
            <div class="form-group col-12 mb-2">
                {!! Form::label('work_info', __('forms.work_info')) !!}
                {!! Form::textarea('work_info', $user->work_info, ['class' => 'form-control', 'rows' => 4]) !!}
            </div>
        @endif
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="col-12 col-md-4 py-2 auth-button" data-loading-text="Loading...">
                {{ __('buttons.save') }}
            </button>
        </div>
    </div>
{!! Form::close() !!}
