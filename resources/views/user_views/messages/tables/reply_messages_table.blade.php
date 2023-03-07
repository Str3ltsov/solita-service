<div class="alert message fade-in d-flex flex-column align-items-start" role="alert">
    <div class="d-flex flex-column w-100">
        <div class="d-flex flex-column flex-md-row gap-md-3 flex-wrap mt-2">
            @if ($message->replyMessage)
                <h6>
                    <i class="fa-solid fa-reply fs-6 me-1"></i>
                    {{ __('names.replyToMessage').': '.$message->topic }}
                </h6>
                @foreach($message->replyMessage->messageUsers as $messageUser)
                    @if ($message->replyMessage->sender_id != auth()->user()->id && $messageUser->marked_as_read)
                        <h6>
                            <i class="fa-solid fa-check fs-6 me-1"></i>
                            {{ __('names.markedAsRead') }}
                        </h6>
                    @endif
                @endforeach
            @endif
        </div>
        <hr>
        <h5>{{ $message->replyMessage->topic }}</h5>
        <div class="d-flex flex-column flex-md-row gap-md-4 gap-lg-3">
            <div class="d-flex flex-column flex-lg-row gap-lg-3">
                <div class="d-flex gap-1">
                    <span>{{ __('names.from') }}:</span>
                    <span class="fw-bold">{{ $message->replyMessage->user->name }}</span>
                </div>
                <div class="d-flex gap-1">
                    <span>{{ __('names.order') }}:</span>
                    <span class="fw-bold">{{ $message->replyMessage->order->name }}</span>
                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row gap-lg-3">
                <div class="d-flex gap-1">
                    <span>{{ __('names.messageType') }}:</span>
                    <span class="fw-bold">{{ $message->replyMessage->type->name }}</span>
                </div>
                <div class="d-flex gap-1">
                    <span>{{ __('table.created_at') }}:</span>
                    <span class="fw-bold">
                        {{ $message->replyMessage->created_at ? $message->replyMessage->created_at->format('Y, F j, H:i') : '' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 1px; width: 100%; background: #ccc; margin: 12px 0">.</div>
    <div class="d-flex flex-column flex-md-row justify-content-between w-100 gap-md-2">
        <p>{{ $message->replyMessage->description }}</p>
        <div class="d-flex justify-content-center">
            <div class="d-flex align-items-start justify-content-center">
                <a href="{{ route('reply', [$prefix, $message->replyMessage->id]) }}" class="mark-as-read-button">
                    <i class="fa-solid fa-reply fs-5"></i>
                </a>
                @foreach ($message->replyMessage->messageUsers as $messageUser)
                    @if ($message->replyMessage->sender_id != auth()->user()->id && $messageUser->user_id == auth()->user()->id && !$messageUser->marked_as_read)
                        {!! Form::open(['route' => ['markAsReadMessage', [$prefix, $message->replyMessage->id]], 'method' => 'post']) !!}
                            <button type="submit" class="mark-as-read-button pt-0 pe-0" title="{{ __('buttons.markAsRead') }}">
                                <i class="fa-solid fa-check fs-4 ms-2"></i>
                            </button>
                        {!! Form::close() !!}
                    @endif
                @endforeach
                @if ($message->replyMessage->sender_id == auth()->user()->id)
                    <a href="{{ route('messages.edit', [$prefix, $message->replyMessage->id]) }}" class="mark-as-read-button">
                        <i class="fa-solid fa-pen-to-square fs-5 ms-3"></i>
                    </a>
                    {!! Form::open(['route' => ['messages.destroy', [$prefix, $message->replyMessage->id]], 'method' => 'delete']) !!}
                    <button type="submit" class="btn mark-as-read-button pt-0" title="{{ __('buttons.deleteMessage') }}"
                            onclick="return confirm('{{ __('names.areYouSureDeleteMessage') }}')">
                        <i class="fa-solid fa-trash-can fs-5"></i>
                    </button>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>
@if ($message->replyMessage->replyMessage)
    @include('user_views.messages.tables.reply_messages_table', ['message' => $message->replyMessage])
@endif
