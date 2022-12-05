{!! Form::model($return, ['route' => ['employeeReturnUpdate', $return->id], 'method' => 'post', 'class' => 'd-flex flex-column flex-md-row']) !!}
    <input type="hidden" name="user_id" value="{{ $return->user->id }}">
    <input type="hidden" name="specialist_id" value="{{ $return->specialist->id }}">
    <input type="hidden" name="employee_id" value="{{ $return->employee->id }}">
    <input type="hidden" name="order_id" value="{{ $return->order_id }}">
    <input type="hidden" name="code" value="{{ $return->code }}">
    <div class="d-flex flex-column flex-md-row gap-4 col-md-9 col-12">
        <div class="form-group col-md-4 col-12">
            {!! Form::label('status_id', __('table.status')) !!}
            {!! Form::select('status_id', $statusList, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
        <div class="form-group col-md-4 col-12">
            {!! Form::label('specialist_id', __('table.specialist')) !!}
            {!! Form::select('specialist_id', $specialistList, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row col-md-3 align-items-md-end col-12 mt-4 mt-md-0">
        <button type="submit" class='btn btn-primary orders-returns-primary-button w-100'>
            {{ __('buttons.save') }}
        </button>
    </div>
{!! Form::close() !!}
