@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('reports.usersReport')}}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="card mb-4">
            @include('users_report.filter')
        </div>
        <div class="card p-2">
            @include('users_report.report')
        </div>
    </div>
@endsection

