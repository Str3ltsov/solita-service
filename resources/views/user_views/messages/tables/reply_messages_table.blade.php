@foreach($message->replyMessages as $replyMessage)
    <div class="alert message fade-in d-flex flex-column align-items-start" role="alert">
        <div class="d-flex flex-column w-100">
            <div class="d-flex flex-column flex-md-row gap-md-3 flex-wrap mt-2">
                @if ($replyMessage->replyMessages)
                    <h6>
                        <i class="fa-solid fa-reply fs-6 me-1"></i>
                        {{ __('names.replyToMessage').': '.$replyMessage->replyMessage_->topic }}
                    </h6>
                    @foreach($replyMessage->messageUsers as $messageUser)
                        @if ($replyMessage->sender_id != auth()->user()->id && $messageUser->marked_as_read)
                            <h6>
                                <i class="fa-solid fa-check fs-6 me-1"></i>
                                {{ __('names.markedAsRead') }}
                            </h6>
                        @endif
                    @endforeach
                @endif
            </div>
            <hr>
            <h5>{{ $replyMessage->topic }}</h5>
            <div class="d-flex flex-column flex-md-row gap-md-4 gap-lg-3">
                <div class="d-flex flex-column flex-lg-row gap-lg-3">
                    <div class="d-flex gap-1">
                        <span>{{ __('names.from') }}:</span>
                        <span class="fw-bold">{{ $replyMessage->user->name }}</span>
                    </div>
                    <div class="d-flex gap-1">
                        <span>{{ __('names.order') }}:</span>
                        <span class="fw-bold">{{ $replyMessage->order->name }}</span>
                    </div>
                </div>
                <div class="d-flex flex-column flex-lg-row gap-lg-3">
                    <div class="d-flex gap-1">
                        <span>{{ __('names.messageType') }}:</span>
                        <span class="fw-bold">{{ $replyMessage->type->name }}</span>
                    </div>
                    <div class="d-flex gap-1">
                        <span>{{ __('table.created_at') }}:</span>
                        <span class="fw-bold">
                        {{ $replyMessage->created_at ? $replyMessage->created_at->format('Y, F j, H:i') : '' }}
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 1px; width: 100%; background: #ccc; margin: 12px 0">.</div>
        <div class="d-flex flex-column flex-md-row justify-content-between w-100 gap-md-2">
            <p>{!! $replyMessage->description !!}</p>
            <div class="d-flex justify-content-center">
                <div class="d-flex align-items-start justify-content-center">
                    @if ($replyMessage->sender_id != auth()->user()->id)
                        <a href="{{ route('reply', [$prefix, $replyMessage->id]) }}" class="mark-as-read-button">
                            <i class="fa-solid fa-reply fs-5 me-2"></i>
                        </a>
                    @endif
                    @foreach ($replyMessage->messageUsers as $messageUser)
                        @if ($replyMessage->sender_id != auth()->user()->id && $messageUser->user_id == auth()->user()->id && !$messageUser->marked_as_read)
                            {!! Form::open(['route' => ['markAsReadMessage', [$prefix, $replyMessage->id]], 'method' => 'post']) !!}
                            <button type="submit" class="mark-as-read-button pt-0 pe-0" title="{{ __('buttons.markAsRead') }}">
                                <i class="fa-solid fa-check fs-4"></i>
                            </button>
                            {!! Form::close() !!}
                        @endif
                    @endforeach
                    @if ($replyMessage->sender_id == auth()->user()->id)
                        <a href="{{ route('messages.edit', [$prefix, $replyMessage->id]) }}" class="mark-as-read-button">
                            <i class="fa-solid fa-pen-to-square fs-5 ms-3"></i>
                        </a>
                        {!! Form::open(['route' => ['messages.destroy', [$prefix, $replyMessage->id]], 'method' => 'delete']) !!}
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
    @if ($replyMessage->replyMessages)
        @include('user_views.messages.tables.reply_messages_table', ['message' => $replyMessage])
    @endif
@endforeach
