@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid pt-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('names.userTypes')}}</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary"
                       href="{{ route('roles.create') }}">
                        {{__('buttons.addNew')}}</a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('roles.table')
            </div>

        </div>
    </div>
@endsection

