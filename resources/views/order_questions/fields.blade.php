@foreach (config('translatable.locales') as $locale)
    <div class="form-group col-12 mb-2">
        {!! Form::label("question_$locale", __('forms.question').' '.$locale.':') !!}
        {!! Form::text("question_$locale", (isset($orderQuestion) && isset($orderQuestion->translate($locale)->question) ? $orderQuestion->translate($locale)->question : null), ['class' => 'form-control']) !!}
    </div>
@endforeach
