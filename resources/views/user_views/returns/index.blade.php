@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.returns') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-4 mt-3" style="font-family: 'Times New Roman', sans-serif">
                    <h3>{{__('names.returns')}}</h3>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered mb-3" id="categories" style="border-inline: 1px solid #e3e3e3; border-bottom: none">
                            <thead style="background: #e3e3e3">
                            <tr>
                                <th>{{__("names.return")}} ID</th>
                                <th>{{__('table.date')}}</th>
                                <th>{{__('table.status')}}</th>
                                <th> </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($returns as $item)
                                <tr>
                                    <td class="ps-3 text-start align">{{ $item->id }}</td>
                                    <td class="ps-3 text-start">{{ $item->created_at->format('Y-m-d H:m') }}</td>
                                    <td class="ps-3 text-start">{{ __("status." . $item->status->name) }}</td>
                                    <td class="text-start" width="120">
                                        <div class='btn-group w-100 d-flex justify-content-center align-items-center'>
                                            <a href="{{ route('viewreturn', [$item->id]) }}"
                                               class='btn btn-primary orders-returns-primary-button'>
                                                <i class="far fa-eye me-1"></i>
                                                {{ __('buttons.details') }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="ps-3">{{__('names.noReturns')}}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

