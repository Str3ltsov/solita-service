@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('names.dataExpImp')}}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        <div class="row px-3">
            @include('flash::message')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="clearfix"></div>
            <div class="card p-2 col-sm-3">
                <div class="card-header">
                    <h3>{{__('names.export')}}</h3>
                </div>
                <div class="card-body">
                    @include('data_export_import.export_form')
                </div>
                <div class="card-header">
                    <h3>{{__('names.import')}}</h3>
                </div>
                <div class="card-body">
                    @include('data_export_import.import_form')
                </div>
            </div>
            <div class="card p-2 col-sm h-auto"></div>
        </div>
    </div>
@endsection
