@if ($message->subject === 'Return')
    <div class="d-flex flex-column">
        <span class="fst-italic">
            {{ '!! '.__('names.newReturn').' !!' }}
        </span>
        <span class="mb-1">
            {{ $message->message_text }}
        </span>
        @if (auth()->user()->type === 3)
            <a href="{{ route('employeeOrderDetails', [$prefix, $message->order_id]) }}"
               class="fw-bold messenger-message-link">
                {{ '• '.__('table.orderId').' '.$message->order_id}}
            </a>
            <a href="{{ route('employeeReturnDetails', [$prefix, $message->return_id]) }}"
               class="fw-bold messenger-message-link">
                {{ '• '.__('table.returnId').' '.$message->return_id}}
            </a>
        @else
            <a href="{{ route('vieworder', [$prefix, $message->order_id]) }}"
               class="fw-bold messenger-message-link">
                {{ '• '.__('table.orderId').' '.$message->order_id}}
            </a>
            <a href="{{ route('viewreturn', [$prefix, $message->return_id]) }}"
               class="fw-bold messenger-message-link">
                {{ '• '.__('table.returnId').' '.$message->return_id}}
            </a>
        @endif
    </div>
@else
    @if ($message->user_from === $user->id)
        {{ $message->message_text }}
    @else
        <div id="messenger-readonly-message-container">
            {{ $message->message_text }}
            <button type="button" wire:click="makeMessengerContainerEditable" id="messenger-readonly-message-container-button">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
        </div>
        <form wire:submit.prevent="editMessage({{ $message->id }}, {{ $index }})" id="messenger-edit-message-container">
            <input type="text" wire:model.defer="messages.{{ $index }}.message_text" class="messenger-message-input">
            <button type="submit" id="messenger-edit-message-container-button">
                {{ __('buttons.save') }}
            </button>
        </form>
    @endif
@endif
