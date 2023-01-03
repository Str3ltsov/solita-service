<div @if (!$editingMessage) wire:poll.1s='updateMessages' @endif class="messenger-room p-4">
    <div>
        <h6 class="messenger-chat-user-name">
            {{ $user->name }}
        </h6>
    </div>
    <div class="messenger-message-box" id="messsageBox">
        @forelse ($messages as $index => $message)
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

        const readonlyMessageContainers = document.querySelectorAll('#messenger-readonly-message-container');
        const readonlyMsgContainerButtons = document.querySelectorAll('#messenger-readonly-message-container-button');
        const editMsgContainers = document.querySelectorAll('#messenger-edit-message-container');
        const editMsgContainerButtons = document.querySelectorAll('#messenger-edit-message-container-button');

        editMsgContainers.forEach(container => container.classList.add('d-none'));

        document.addEventListener('livewire:load', () => {
            editMsgContainers.forEach(container => container.classList.add('d-none'));
        });

        let globalEvent = undefined;
        let containerIndex = null;
        let editButtonIndex = null;
        let readonlyButtonIndex = null;

        window.addEventListener('msgContainerEvent', event => {
            globalEvent = event.detail;

            editMsgContainers.forEach((container, index) => {
                containerIndex = index;

                if (containerIndex === editButtonIndex)
                    readonlyMessageContainers[index].classList.add('d-none');
                else
                    container.classList.add('d-none');

                if (containerIndex === readonlyButtonIndex) {
                    readonlyMessageContainers[index].classList.remove('d-none');
                    container.classList.add('d-none');
                }
            });
        });

        readonlyMsgContainerButtons.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                editButtonIndex = index;
                readonlyMessageContainers[index].classList.add(globalEvent);
                editMsgContainers[index].classList.remove(globalEvent);
            });
        });

        editMsgContainerButtons.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                readonlyButtonIndex = index;
                readonlyMessageContainers[index].classList.remove(globalEvent);
                editMsgContainers[index].classList.add(globalEvent);
            });
        });
    </script>
@endpush
