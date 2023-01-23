{!! Form::model($order, ['route' => ['employeeOrderUpdate', $order->id], 'method' => 'post', 'class' => 'd-flex flex-column']) !!}
    <input type="hidden" name="order_id" value="{{ $order->order_id }}">
    <input type="hidden" name="user_id" value="{{ $order->user->id }}">
    <input type="hidden" name="employee_id" value="{{ $order->employee->id }}">
    <input type="hidden" name="name" value="{{ $order->name }}">
    <input type="hidden" name="delivery_time" value="{{ $order->delivery_time }}">
    <input type="hidden" name="budget" value="{{ $order->budget }}">
    <input type="hidden" name="start_date" value="{{ $order->start_date->format('Y-m-d') }}">
    <div class="row d-flex flex-column flex-md-row">
        <div class="form-group col-md-3 col-12">
            {!! Form::label('status_id', __('table.status')) !!}
            {!! Form::select('status_id', $statusList, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
        <div class="form-group col-md-3 col-12">
            {!! Form::label('priority_id', __('table.priority')) !!}
            {!! Form::select('priority_id', $priorityList, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
        <div class="form-group col-md-3 col-12">
            {!! Form::label('total_hours', __('table.totalHours')) !!}
            {!! Form::number('total_hours', $order->total_hours, ['class' => 'form-control', 'style' => 'padding: 14px; font-size: 1em; border-color: #eeeeee; border-radius: 0']) !!}
        </div>
        <div class="form-group col-md-3 col-12">
            {!! Form::label('end_date', __('table.endDate')) !!}
            {!! Form::date('end_date', $order->end_date, [
                'min' => $order->end_date->format('Y-m-d'),
                'class' => 'form-control',
                'style' => 'padding: 14px; font-size: 1em; border-color: #eeeeee; border-radius: 0'
            ]) !!}
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center mt-4 col-12">
        <button type="submit" class='btn btn-primary orders-returns-primary-button col-lg-4 col-md-6 col-12'>
            {{ __('buttons.save') }}
        </button>
    </div>
{!! Form::close() !!}
