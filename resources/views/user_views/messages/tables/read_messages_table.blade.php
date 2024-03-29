@forelse($readMessages as $readMessage)
    <div class="alert message fade-in d-flex flex-column flex-md-row gap-md-4 gap-3 p-4" role="alert">
        <div class="d-flex align-items-center gap-3 w-100" style="color: #444">
            <div class="d-flex flex-column w-100" style="color: #aaa">
                @if ($readMessage->message->reply_message_id)
                    <h6 style="color: #aaa">
                        <i class="fa-solid fa-reply fs-6 me-1"></i>
                        {{ __('names.replyToMessage').': '.$readMessage->message->mainMessage->topic }}
                    </h6>
                @endif
                <h5 style="color: #aaa">{{ $readMessage->message->topic }}</h5>
                <div class="d-flex flex-column flex-md-row gap-md-3 flex-wrap">
                    <div class="d-flex gap-1">
                        <span>{{ __('names.from') }}:</span>
                        <span class="fw-bold">{{ $readMessage->message->user->name }}</span>
                    </div>
                    <div class="d-flex gap-1">
                        <span>{{ __('table.created_at') }}:</span>
                        <span class="fw-bold">{{ $readMessage->message->created_at->format('Y, F j, H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center gap-1">
            @if ($readMessage->message->mainMessage)
                <a href="{{ route('messages.show', [$prefix, $readMessage->message->mainMessage->id]) }}" class="mark-as-read-button">
                    <i class="fa-solid fa-eye fs-5 me-2"></i>
                </a>
            @else
                <a href="{{ route('messages.show', [$prefix, $readMessage->message->id]) }}" class="mark-as-read-button">
                    <i class="fa-solid fa-eye fs-5 me-2"></i>
                </a>
            @endif
            @if ($readMessage->message->sender_id == auth()->user()->id)
                {!! Form::open(['route' => ['messages.destroy', [$prefix, $readMessage->message->id]], 'method' => 'delete']) !!}
                    <button type="submit" class="mark-as-read-button" title="{{ __('buttons.deleteMessage') }}"
                            onclick="return confirm('{{ __('names.areYouSureDeleteMessage') }}')">
                        <i class="fa-solid fa-trash-can fs-5"></i>
                    </button>
                {!! Form::close() !!}
            @endif
        </div>
    </div>
@empty
    <span class="text-muted p-0 m-0">{{ __('names.noMessages') }}</span>
@endforelse
@if (count($readMessages) >= 5)
    <div class="mt-4">
        {{ $readMessages->onEachSide(1)->links() }}
    </div>
@endif
