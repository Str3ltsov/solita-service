@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/user/rootoreturns") }}">
                {{ __('menu.returns') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $return->id ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12 d-flex flex-column gap-4">
                <div class="row">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between">
                        <div class="mb-2 mb-md-0">
                            <h3 class="mt-3 mb-2" style="font-family: 'Times New Roman', sans-serif">
                                {{__('names.return')}}: {{ $return->id }}
                            </h3>
                            <div class="d-flex gap-4">
                                <div class="d-flex flex-column">
                                    <div class="d-flex gap-2 text-muted">
                                        {{__('table.specialist')}}:
                                        <a href="{{ route('userReviews', [$return->specialist_id]) }}" class="fw-bold d-flex gap-1">
                                            {{ __($return->specialist->name) }}
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
                                        <a href="{{ route('userReviews', [$return->employee_id]) }}" class="fw-bold d-flex gap-1">
                                            {{ __($return->employee->name) }}
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
                                        {{__('names.orderStatus')}}: {{ __("status." . $return->status->name) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    <h5 class="my-2">{{ __('names.products') }}</h5>
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered my-3">
                            <thead style="background: #e7e7e7;">
                                <tr>
                                    <th class="px-3">{{__('table.productName')}}</th>
                                    <th class="px-3">{{__('table.price')}}</th>
                                    <th class="px-3">{{__('table.count')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($returnItems as $item)
                                    <tr>
                                        <td class="px-3">{{ $item->product->name }}</td>
                                        <td class="px-3">{{ number_format($item->price_current,2) }} €</td>
                                        <td class="px-3">{{ $item->count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="background: #e7e7e7;">
                                <tr class="fw-bold" style="border-top: 2px solid black">
                                    <td class="px-3">{{ __('names.total') }}</td>
                                    <td class="px-3">{{ $returnItemCountSum }}</td>
                                    <td class="px-3">{{ number_format($returnItemPriceSum, 2) }} €</td>
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

