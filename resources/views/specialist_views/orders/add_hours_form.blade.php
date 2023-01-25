{!! Form::open(['route' => ['specialistOrderAddHours', $order->id], 'method' => 'post', 'class' => 'd-flex flex-column']) !!}
    <div class="row d-flex flex-column flex-md-row align-items-end justify-content-between gap-4 gap-md-0">
        <div class="form-group col-md-4 col-12">
            {!! Form::label('hours', __('forms.hours')) !!}
            {!! Form::number('hours', 0, ['class' => 'form-select', 'style' => 'padding: 15px;', 'min' => 1]) !!}
        </div>
        <div class="col-md-4 col-12">
            <button type="submit" class='btn btn-primary orders-returns-primary-button w-100'>
                {{ __('buttons.save') }}
            </button>
        </div>
    </div>
{!! Form::close() !!}
