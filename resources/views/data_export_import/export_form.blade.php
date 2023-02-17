{!! Form::open(['route' => 'data_export_import.export', 'method' => 'GET', 'class' => 'row']) !!}
    <div class="form-group col-6 mb-3">
        {!! Form::label("table",  __('names.table').':') !!}
        {!! Form::select('table',
            $tables,
            null,
            ['class' => 'form-select', 'placeholder' => __('names.select')]) !!}
    </div>
    <div class="form-group col-6 mb-3">
        {!! Form::label("file_type",  __('names.exportAs').':') !!}
        {!! Form::select('file_type',
            $file_types,
            null,
            ['class' => 'form-select', 'placeholder' => __('names.select')]) !!}
    </div>
    <div class="d-flex align-items-center justify-content-center my-2 col-12">
        <button type="submit" class='btn btn-primary orders-returns-primary-button col-lg-4 col-md-6 col-12'>
            {{ __('buttons.export') }}
        </button>
    </div>
{!! Form::close() !!}
