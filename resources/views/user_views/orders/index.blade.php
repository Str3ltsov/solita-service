@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.orders') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-4 mt-3" style="font-family: 'Times New Roman', sans-serif">
                    <h3>{{__('names.orders')}}</h3>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered mb-3" id="categories">
                            <thead style="background: #e7e7e7;">
                                <tr>
                                    <th class="text-center" width="10">#</th>
                                    <th>{{ __('table.orderId') }}</th>
                                    <th>{{ __('table.specialist') }}</th>
                                    <th>{{ __('table.employee') }}</th>
                                    <th>{{ __('table.status') }}</th>
                                    <th>{{ __('table.deliveryTime') }}</th>
                                    <th>{{ __('table.sum') }}</th>
                                    <th>{{ __('table.date') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $item)
                                    <tr>
                                        <td class="ps-3 text-center">{{ $loop->index + 1 }}</td>
                                        <td class="ps-3 text-start align">{{ $item->id }}</td>
                                        <td class="ps-3 text-start align">{{ $item->specialist->name }}</td>
                                        <td class="ps-3 text-start align">{{ $item->employee->name }}</td>
                                        <td class="ps-3 text-start">{{ __("status." . $item->status->name) }}</td>
                                        <td class="ps-3 text-start">{{ __($item->delivery_time).' '.__('names.days') }}</td>
                                        <td class="ps-3 text-start">{{ number_format($item->sum,2) }} €</td>
                                        <td class="ps-3 text-start">{{ $item->created_at->format('Y-m-d H:m') }}</td>
                                        <td class="text-start" width="120">
                                            <div class='btn-group w-100 d-flex justify-content-center align-items-center'>
                                                <a href="{{ route('vieworder', [$prefix, $item->id]) }}"
                                                   class='btn btn-primary orders-returns-primary-button'>
                                                    <i class="far fa-eye me-1"></i>
                                                    {{ __('buttons.details') }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="ps-3">>{{__('names.noOrders')}}</td>
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

