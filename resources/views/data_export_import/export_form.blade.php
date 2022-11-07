{!! Form::open(['route' => 'data_export_import.export', 'method' => 'GET']) !!}
    <div class="form-group mb-2">
        {!! Form::label("table",  __('names.table').':', ['class' => 'form-label']) !!}
        {!! Form::select('table',
            $tables,
            null,
            ['class' => 'w-100 form-select', 'placeholder' => 'Select']) !!}
    </div>
    <div class="form-group mb-2">
        {!! Form::label("file_type",  __('names.exportAs').':', ['class' => 'form-label']) !!}
        {!! Form::select('file_type',
            $file_types,
            null,
            ['class' => 'w-100 form-select', 'placeholder' => __('names.select')]) !!}
    </div>
    <div class="form-group">
        {!! Form::submit(__('buttons.export'), ['class' => 'btn btn-primary mt-2']) !!}
    </div>
{!! Form::close() !!}
