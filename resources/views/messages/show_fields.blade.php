<!-- Subject Field -->
<div class="col-sm-12">
    {!! Form::label('subject',  __('messages.subject'),':') !!}
    <p>{{ $message->subject }}</p>
</div>

<!-- Message Text Field -->
<div class="col-sm-12">
    {!! Form::label('message_text', __('messages.textMsg'),':') !!}
    <p>{{ $message->message_text }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at',  __('messages.created_at'),':') !!}
    <p>{{ $message->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at',  __('messages.updated_at'),':') !!}
    <p>{{ $message->updated_at }}</p>
</div>

