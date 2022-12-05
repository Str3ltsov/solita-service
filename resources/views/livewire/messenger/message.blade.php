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
    {{ $message->message_text }}
@endif