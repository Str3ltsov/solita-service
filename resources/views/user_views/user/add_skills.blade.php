{!! Form::model($user, ['route' => ['addSkill'], 'method' => 'post', 'class' => 'auth-form-container px-0']) !!}
    <div class="row">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="form-group col-md-6 col-12 mb-2">
            {!! Form::label('skill_id', __('names.skills').':') !!}
            {!! Form::select('skill_id', $skills, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
        <div class="form-group col-md-6 col-12 mb-2">
            {!! Form::label('experience', __('names.experience').' ('.__('names.years').')') !!}
            {!! Form::select('experience', $skillExperiences, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="col-12 col-md-4 py-2 auth-button" data-loading-text="Loading...">
                {{ __('buttons.save') }}
            </button>
        </div>
    </div>
{!! Form::close() !!}
