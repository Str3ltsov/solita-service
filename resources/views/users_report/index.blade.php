@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('reports.usersReport') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mt-3 mb-4">
                    <h3 class="mb-4 mb-md-0">
                        {{ __('reports.usersReport') }}
                    </h3>
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <button type="button" onclick="getReport('/download_pdf')"
                                class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-file-pdf fs-6 me-2"></i>
                            {{ __('reports.download') }} PDF
                        </button>
                        <button type="button" onclick="getReport('/download_csv')"
                                class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-file-csv fs-6 me-2"></i>
                            {{ __('reports.download') }} CSV
                        </button>
                        <button type="button" onclick="getReport('/email')"
                                class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-envelope fs-6 me-2"></i>
                            {{ __('reports.sendEmail') }}
                        </button>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3 mb-4 border-around">
                    @include('users_report.filter')
                </div>
                <div class="row bg-white mx-md-0 p-3 border-around">
                    <div class="table table-responsive pt-1">
                        @include('users_report.report')
                    </div>
                    <div class="d-flex justify-content-center align-items-center my-3">
                        {{ $users->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



