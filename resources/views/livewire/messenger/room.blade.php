<div wire:poll.1s='updateMessages' class="messenger-room p-4">
    <div>
        <h6 class="messenger-chat-user-name">
            {{ $user->name }}
        </h6>
    </div>
    <div class="messenger-message-box" id="messsageBox">
        @forelse ($messages ?? [] as $message)
            @if ($message->user_from === $user->id)
                <div class="messenger-message-from-container">
                    {{--
                    <span style="width: clamp(50px, 200px);">
                        {{$user->name}}
                    </span>
                    --}}
                    <span class="messenger-message-from">
                        @include('livewire.messenger.message')
                    </span>
                </div>
                <div class="messenger-message-from-date-container">
                    <span class="messenger-message-date">
                        {{ $message->created_at->format('M d, H:i A') }}
                    </span>
                </div>
            @else
            <div class="messenger-message-to-container">
                <span class="messenger-message-to">
                    @include('livewire.messenger.message')
                    <form wire:submit.prevent="deleteMessage({{ $message->id }})"><button type="submit" class="button"><i class="fa-solid fa-trash"></i></button></form>
                </span>
            </div>

                <div class="messenger-message-to-date-container">
                    <span class="messenger-message-date">{{ $message->created_at->format('M d, H:i A') }}</span>
                </div>
            @endif
        @empty
            <div style="display: flex; justify-content: center; align-items: center;">
                <span class="text-muted">{{ __('messages.emptyChat') }}</span>
            </div>
        @endforelse
    </div>
    @include('livewire.messenger.form')
</div>

@push('scripts')
    <script>
        const messageBox = document.getElementById('messsageBox');
        messageBox.scrollTop = messageBox.scrollHeight;
    </script>
@endpush

@push('css')
  <style>
    .messenger-message-to-container {
      position: relative; /* or any other positioning as desired */
      /* add other styles as needed */
    }

    .messenger-message-to-container .button {
      position: absolute;
      top: 50%;
      right: 0;
      transform: translateY(-50%);
      background: transparent;
      border: none;
    }

    .messenger-message-to-container .button i {
      color: #fff; /* or any other color as desired */
    }
  </style>
@endpush



