{!! Form::model($message, ['route' => ['messages.update', [$prefix, $message->id]], 'method' => 'put', 'class' => 'd-flex flex-column']) !!}
<div class="row">
    <div class="form-group col-12">
        {!! Form::label('topic', __('table.title')) !!}
        {!! Form::text('topic', $message->topic, ['class' => 'form-control', 'style' => 'padding: 14px; font-size: 1em; border-color: #eeeeee; border-radius: 0']) !!}
    </div>
    <div class="form-group col-12">
        {!! Form::label('description', __('table.description')) !!}
        {!! Form::textarea('description', $message->description, ['class' => 'form-control', 'rows' => 5, 'style' => 'padding: 14px; font-size: 1em; border-color: #eeeeee; border-radius: 0']) !!}
    </div>
    <div class="d-flex align-items-center justify-content-center mt-4 col-12">
        <button type="submit" class='btn btn-primary orders-returns-primary-button col-lg-4 col-md-6 col-12'>
            {{ __('messages.send') }}
        </button>
    </div>
{!! Form::close() !!}
