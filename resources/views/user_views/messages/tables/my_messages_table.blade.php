@forelse($myMessages as $message)
    <div class="alert message fade-in d-flex flex-column flex-md-row gap-md-4 gap-3 p-4" role="alert">
        <div class="d-flex flex-column w-100">
            @if ($message->reply_message_id)
                <h6>
                    <i class="fa-solid fa-reply fs-6 me-1"></i>
                    {{ __('names.replyToMessage').': '.$message->replyMessage_->topic }}
                </h6>
            @endif
            <h5>{{ $message->topic }}</h5>
            <div class="d-flex flex-column flex-md-row gap-md-3 flex-wrap">
                <div class="d-flex gap-1">
                    <span>{{ __('names.from') }}:</span>
                    <span class="fw-bold">{{ $message->user->name }}</span>
                </div>
                <div class="d-flex gap-1">
                    <span>{{ __('table.created_at') }}:</span>
                    <span class="fw-bold">{{ $message->created_at->format('Y, F j, H:i') }}</span>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center gap-1">
            @if ($message->mainMessage)
                <a href="{{ route('messages.show', [$prefix, $message->mainMessage->id]) }}" class="mark-as-read-button">
                    <i class="fa-solid fa-eye fs-5 me-1"></i>
                </a>
            @else
                <a href="{{ route('messages.show', [$prefix, $message->id]) }}" class="mark-as-read-button">
                    <i class="fa-solid fa-eye fs-5 me-1"></i>
                </a>
            @endif
{{--            <a href="{{ route('messages.edit', [$prefix, $message->id]) }}" class="mark-as-read-button">--}}
{{--                <i class="fa-solid fa-pen-to-square fs-5"></i>--}}
{{--            </a>--}}
            {!! Form::open(['route' => ['messages.destroy', [$prefix, $message->id]], 'method' => 'delete']) !!}
                <button type="submit" class="btn mark-as-read-button" title="{{ __('buttons.deleteMessage') }}"
                        onclick="return confirm('{{ __('names.areYouSureDeleteMessage') }}')">
                    <i class="fa-solid fa-trash-can fs-5"></i>
                </button>
            {!! Form::close() !!}
        </div>
    </div>
@empty
    <span class="text-muted p-0 m-0">{{ __('names.noMessages') }}</span>
@endforelse
@if (count($myMessages) >= 5)
    <div class="mt-4">
        {{ $myMessages->onEachSide(1)->links() }}
    </div>
@endif
