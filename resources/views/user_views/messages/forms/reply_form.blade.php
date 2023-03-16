{!! Form::open(['route' => ['messages.store', $prefix], 'method' => 'post', 'class' => 'd-flex flex-column']) !!}
<div class="row">
    <input type="hidden" name="sender_id" value="{{ auth()->user()->id }}">
    <input type="hidden" name="reply_message_id" value="{{ $message->id }}">
    <input type="hidden" name="main_message_id" value="{{ $mainMessage->id }}">
    <div class="form-group col-12">
        {!! Form::label('topic', __('table.title')) !!}
        {!! Form::text('topic', null, ['class' => 'form-control', 'style' => 'padding: 14px; font-size: 1em; border-color: #eeeeee; border-radius: 0']) !!}
    </div>
    <div class="form-group col-md-8 col-12 d-none">
        {!! Form::label('order_id', __('names.order')) !!}
        {!! Form::select('order_id', $order, $order, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
    </div>
    <div class="form-group col-md-4 col-12 d-none">
        {!! Form::label('message_type_id', __('names.messageType')) !!}
        {!! Form::select('message_type_id', $type, $type, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
    </div>
    <div class="form-group col-md-3 col-12 d-none">
        {!! Form::label('users', __('names.user')) !!}
        {!! Form::select('users[]', $users, $users, ['class' => 'form-select', 'style' => 'height: 50px; padding: 6px;', 'multiple']) !!}
    </div>
    <div class="form-group col-12">
        {!! Form::label('description', __('table.description')) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'style' => 'padding: 14px; font-size: 1em; border-color: #eeeeee; border-radius: 0']) !!}
    </div>
    <div class="d-flex align-items-center justify-content-center mt-4 col-12">
        <button type="submit" class='btn btn-primary orders-returns-primary-button col-lg-4 col-md-6 col-12'>
            {{ __('messages.send') }}
        </button>
    </div>
{!! Form::close() !!}

@push('scripts')
    <script>
        const orderSelector = document.querySelector('select[name="order_id"]')
        const messageTypeSelector = document.querySelector('select[name="message_type_id"]')
        const userSelector = document.querySelector('select[name="users[]"]')

        orderSelector.readonly = true;
        messageTypeSelector.readonly = true;
        userSelector.readonly = true;

        const options = Array.from(userSelector.options)

        options.map(option => option.selected = true);
    </script>
@endpush
