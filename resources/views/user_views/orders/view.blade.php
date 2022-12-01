@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/user/rootorders") }}">
                {{ __('menu.orders') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $order->order_id ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12 d-flex flex-column gap-4">
                <div class="row">
                    <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between">
                        <div class="d-flex flex-column mb-2 mb-md-0">
                            <h3 class="mt-3 mb-2" style="font-family: 'Times New Roman', sans-serif">
                                {{__('names.order')}}: {{ $order->order_id }}
                            </h3>
                            <div class="d-flex align-items-center gap-4">
                                <div class="d-flex flex-column">
                                    <div class="d-flex gap-2 text-muted">
                                        {{__('table.specialist')}}:
                                        <a href="{{ route('userReviews', [$order->specialist_id]) }}" class="fw-bold d-flex gap-1">
                                            {{ __($order->specialist->name) }}
                                            <div class="d-flex align-items-center">
                                                <span>{{ round(number_format($reviewAverageRating['specialist'], 2), 1) }}</span>
                                                    <span>/</span>
                                                    <span>5</span>
                                                @if ($reviewAverageRating > 0)
                                                    <i class="fa-solid fa-star text-warning ms-1"></i>
                                                @else
                                                    <i class="fa-regular fa-star text-warning ms-1"></i>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <div class="d-flex gap-2 text-muted">
                                        {{__('table.employee')}}:
                                        <a href="{{ route('userReviews', [$order->employee_id]) }}" class="fw-bold d-flex gap-1">
                                            {{ __($order->employee->name) }}
                                            <div class="d-flex align-items-center">
                                                <span>{{ round(number_format($reviewAverageRating['employee'], 2), 1) }}</span>
                                                    <span>/</span>
                                                    <span>5</span>
                                                @if ($reviewAverageRating > 0)
                                                    <i class="fa-solid fa-star text-warning ms-1"></i>
                                                @else
                                                    <i class="fa-regular fa-star text-warning ms-1"></i>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                <span class="text-muted">
                                    {{__('names.orderStatus')}}: {{ __("status." . $order->status->name) }}
                                </span>
                                    <span class="text-muted">
                                    {{__('table.deliveryTime')}}: {{ __($order->delivery_time).' '.__('names.days') }}
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row gap-3 mt-2 mt-md-0">
                            @if($order->status->name !== "Returned" && $order->status->name !== "Canceled")
                                <div class="btn-group" style="float: right">
                                    <a href="{{ route('returnorder', [$order->id]) }}"
                                       class='btn btn-primary orders-returns-primary-button'>
                                        <i class="far fa-arrow-alt-circle-right me-1 fs-6"></i>
                                        {{ __('buttons.return') }}
                                    </a>
                                </div>
                                <div class="btn-group" style="float: right">
                                    <a href="{{ route('cancelnorder', [$order->id]) }}"
                                       class='btn btn-primary orders-returns-primary-button'>
                                        <i class="far fa-trash-alt me-1 fs-6"></i>
                                        {{ __('buttons.cancel') }}
                                    </a>
                                </div>
                                @if($order->status->name == 'Completed')
                                    <div class="btn-group" style="float: right">
                                        <a href="{{ route('download_invoice', [$order->id]) }}"
                                           class='btn btn-primary orders-returns-primary-button'>
                                            <i class="fa-solid fa-file-invoice me-1 fs-6"></i>
                                            {{__('buttons.invoice')}}
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    <h5 class="my-2">{{ __('names.products') }}</h5>
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered my-3">
                            <thead style="background: #e7e7e7;">
                                <tr>
                                    @if($order->status->name == "Returned")
                                        <th class="text-center px-3">{{__('table.status')}}</th>
                                    @endif
                                    <th class="px-3">{{__('table.productName')}}</th>
                                    <th class="px-3">{{__('table.count')}}</th>
                                    <th class="px-3">{{__('table.price')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderItems as $item)
                                    <tr>
                                        @if($order->status->name == "Returned")
                                            <td class="text-center px-3">
                                                @if ($item->isReturned !== null)
                                                    {{__("status." .$item->isReturned)}}
                                                @endif
                                            </td>
                                        @endif
                                        <td class="px-3">{{ $item->product->name }}</td>
                                        <td class="px-3">{{ $item->count }}</td>
                                        <td class="px-3">{{ number_format($item->price_current,2) }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="background: #e7e7e7;">
                                <tr class="fw-bold" style="border-top: 2px solid black">
                                    <td class="px-3" @if ($order->status->name == "Returned") colspan="2" @endif>
                                        {{ __('names.total') }}
                                    </td>
                                    <td class="px-3">{{ $orderItemCountSum }}</td>
                                    <td class="px-3">{{ number_format($order->sum, 2) }} €</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    <h5 class="my-2">{{ __('names.orderHistory') }}</h5>
                    @include('orders.history_table')
                </div>
            </div>
        </div>
    </div>
@endsection

