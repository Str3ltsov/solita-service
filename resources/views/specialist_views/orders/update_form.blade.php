{!! Form::model($order, ['route' => ['specialistOrderUpdate', $order->id], 'method' => 'post', 'class' => 'd-flex flex-column flex-md-row']) !!}
    <input type="hidden" name="user_id" value="{{ $order->user->id }}">
    <input type="hidden" name="specialist_id" value="{{ $order->specialist->id }}">
    <input type="hidden" name="employee_id" value="{{ $order->employee->id }}">
    <div class="d-flex flex-column flex-md-row gap-4 col-md-9 col-12">
        <div class="form-group col-md-4 col-12">
            {!! Form::label('status_id', __('table.status')) !!}
            {!! Form::select('status_id', $statusList, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
        <div class="form-group col-md-4 col-12">
            {!! Form::label('priority_id', __('table.priority')) !!}
            {!! Form::select('priority_id', $priorityList, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
        <div class="form-group col-md-3 col-12">
            {!! Form::label('delivery_time', __('table.deliveryTime').' ('.__('names.days').')') !!}
            {!! Form::number('delivery_time', $order->delivery_time, ['class' => 'form-control', 'style' => 'padding: 14px; font-size: 1em; border-color: #eeeeee; border-radius: 0']) !!}
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row col-md-3 align-items-md-end col-12 mt-4 mt-md-0">
        <button type="submit" class='btn btn-primary orders-returns-primary-button w-100'>
            {{ __('buttons.save') }}
        </button>
    </div>
{!! Form::close() !!}
