{!! Form::model($user, ['route' => ['changePassword', $prefix], 'method' => 'post', 'class' => 'auth-form-container px-0']) !!}
    <div class="row">
        <input type="hidden" name="type" value="{{ $user->type }}">
        <div class="form-group col-md-4 col-sm-12 mb-2">
            {!! Form::label('current_password', __('forms.current_password') )!!}
            {!! Form::password('current_password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12 mb-2">
            {!! Form::label('new_password', __('forms.new_password')) !!}
            {!! Form::password('new_password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12 mb-2">
            {!! Form::label('new_password_confirmation', __('forms.confirm_password')) !!}
            {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="col-12 col-md-4 py-2 auth-button" data-loading-text="Loading...">
                {{ __('buttons.save') }}
            </button>
        </div>
    </div>
{!! Form::close() !!}
