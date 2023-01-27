{!! Form::model($order, ['route' => ['uploadDocument', $prefix], 'method' => 'post', 'files' => true, 'enctype' => "multipart/form-data", 'class' => 'auth-form-container row gap-4 gap-md-0']) !!}
    {{ Form::hidden('order_id', $order->id) }}
    <div class="form-group col-lg-11 col-12 mb-2">
        {!! Form::label('document', __('forms.acceptedFormats')) !!}
        {!! Form::file('document', ['class' => 'form-control', 'style' => 'border-radius: 0']) !!}
    </div>
    <div class="d-flex mt-md-3">
        <button type="submit" class="col-lg-11 col-12 py-2 category-return-button" data-loading-text="Loading...">
            {{ __('buttons.uploadFile') }}
        </button>
    </div>
{!! Form::close() !!}
