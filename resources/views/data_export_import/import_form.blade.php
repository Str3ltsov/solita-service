{!! Form::open(['route' => 'data_export_import.import',
    'method' => 'POST',
    'files' => true,
    'enctype' => 'multipart/form-data',
    'class' => 'row']) !!}
    <div class="form-group col-6 mb-3">
        {!! Form::label("table", __('names.table').':') !!}
        {!! Form::select('table',
            $importTables,
            null,
            ['class' => 'form-select', 'placeholder' =>  __('names.select')]) !!}
    </div>
    <div class="form-group col-6 mb-3">
        {!! Form::label("upload_file",  __('names.uploadFile').':') !!}
        {!! Form::file('file', ['class' => 'form-control', 'style' => 'border-radius: 0']) !!}
    </div>
    <div class="d-flex align-items-center justify-content-center my-2 col-12">
        <button type="submit" class='btn btn-primary orders-returns-primary-button col-lg-4 col-md-6 col-12'>
            {{ __('buttons.import') }}
        </button>
    </div>
{!! Form::close() !!}
