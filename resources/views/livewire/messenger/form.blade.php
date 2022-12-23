<div class="row mt-3">
    <form wire:submit.prevent="sendMessage({{ $user->id }})">
        <div class="messenger-form-container">
            <input
                type="text"
                class="messenger-form-input"
                placeholder="{{__('messages.typeYourMsgHere')}}"
                wire:model.defer="message_text"
                required
            >
            <button type="submit" class="messenger-form-button">
                {{__('messages.send')}}
            </button>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        const msgInput = document.querySelector('.messenger-form-input');
        const msgButton = document.querySelector('.messenger-form-button');

        msgInput.addEventListener("keypress", event => {
            setTimeout(() => {
                if (event.key === "Enter") {
                    msgInput.value = '';
                    event.preventDefault();
                }
            }, 200);
        });
        msgButton.addEventListener("click", event => {
            setTimeout(() => {
                msgInput.value = '';
                event.preventDefault();
            }, 200);
        });
    </script>
@endpush
