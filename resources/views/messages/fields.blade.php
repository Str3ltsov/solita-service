<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', __('messages.subject'), ':') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Text Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('message_text', __('messages.textMsg'), ':') !!}
    {!! Form::textarea('message_text', null, ['class' => 'form-control']) !!}
</div>
