{!! Form::model($order, ['route' => ['specialistOrderUpdate', $order->id], 'method' => 'post', 'class' => 'd-flex flex-column']) !!}
    <input type="hidden" name="user_id" value="{{ $order->user->id }}">
    <input type="hidden" name="employee_id" value="{{ $order->employee->id }}">
    <div class="d-flex flex-column flex-md-row gap-4 col-md-11 col-12">
        <div class="form-group col-md-4 col-12">
            {!! Form::label('status_id', __('table.status')) !!}
            {!! Form::select('status_id', $statusList, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
        <div class="form-group col-md-4 col-12">
            {!! Form::label('priority_id', __('table.priority')) !!}
            {!! Form::select('priority_id', $priorityList, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center mt-4 col-12">
        <button type="submit" class='btn btn-primary orders-returns-primary-button col-lg-4 col-md-6 col-12'>
            {{ __('buttons.save') }}
        </button>
    </div>
{!! Form::close() !!}
