@extends('layouts.export')
@section('content')
    <div class="d-flex flex-column bg-white overflow-scroll" style="width: clamp(500px, 100%, calc(3508px / 4)); padding: 150px 50px 300px 50px">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex flex-column fst-italic col-6" style="line-height: 22px">
                <div class="d-flex gap-1">
                    <b>{{ __('table.startDate') }}:</b>
                    <span>{{ $order->start_date ? $order->start_date->format('Y-m-d') : '' }}</span>
                </div>
                <div class="d-flex gap-1">
                    <b>{{ __('table.startDate') }}:</b>
                    <span>{{ $order->end_date ? $order->end_date->format('Y-m-d') : '' }}</span>
                </div>
            </div>
            <div class="d-flex align-items-end col-6">
                <h4 class="text-uppercase" style="font-family: Cambria, Georgia, serif; color: #666">
                    {{ __('names.commerceOffer').' #'.$order->id }}
                </h4>
            </div>
        </div>
        <div class="mt-5 mb-3 pt-5 d-flex" style="border-bottom: 1px #999 solid">
            <div class="col-8"></div>
            <div class="col-auto">
                <span class="text-uppercase fs-6 fst-italic" style="font-weight: 300">{{ __('names.client') }}:</span>
            </div>
        </div>
        <div class="d-flex justify-content-between w-100 fst-italic" style="line-height: 18px">
            <div class="d-flex flex-column gap-1 col-8">
                <b>UAB Solita</b>
                <span>Taikos per. 88A, LT-51182 Kaunas</span>
                <span>{{ __('names.companyCode') }}: 304764201</span>
                <span>{{ __('names.vatCode') }}: LT100011832719</span>
                <span>{{ __('forms.phone_number') }}: +370 37 247749</span>
            </div>
            <div class="d-flex flex-column gap-1 col-4">
                <b>{{ $order->user->name ?? '' }}</b>
                <span>
                    {{ $order->user->street ?? '' }}
                    {{ $order->user->house_flat ?? '' }}@if ($order->user->post_index !== null),@endif
                    {{ $order->user->post_index ?? '' }}
                    {{ $order->user->city ?? '' }}
                </span>
                <span>{{ $order->user->phone_number && __('forms.phone_number').': +'.$order->user->phone_number }}</span>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center mt-5">
            <table class="table table-bordered table-responsive overflow-scroll">
                <thead>
                <tr class="text-uppercase text-white text-center bg-dark" style="background: #555">
                    <td>{{ __('table.name') }}</td>
                    <td>{{ __('names.quantity') }}</td>
                    <td>{{ __('table.price') }}</td>
                    <td>{{ __('table.total') }}</td>
                    <td>{{ __('names.vat') }}</td>
                </tr>
                </thead>
                <tbody>
                <tr style="font-family: Calibri, serif">
                    <td class="text-center">{{ $order->name }}</td>
                    <td class="text-center">{{ $order->total_hours.' '.__('names.shortPerHour') }}</td>
                    <td class="text-center">{{ number_format($order->budget, 2) }}</td>
                    <td class="text-center">{{ number_format(($order->budget * $order->total_hours), 2) }}</td>
                    <td class="text-center">{{ number_format(($order->budget * $order->total_hours * 21) / 100, 2).' (21.00%)' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-5">
            <div class="col-auto col-md-7">
            </div>
            <div class="col-md-5 d-flex justify-content-end gap-4">
                <div class="d-flex flex-column align-items-end" style="letter-spacing: 4px">
                    <span class="text-uppercase">{{ __('table.total') }}</span>
                    <span class="text-uppercase">{{ __('names.vat') }}</span>
                    <span class="fw-bold">{{ __('names.absoluteTotal') }}</span>
                </div>
                <div class="d-flex flex-column align-items-end">
                    <span>{{ number_format($order->budget, 2).' €' }}</span>
                    <span>{{ number_format(($order->budget * $order->total_hours * 21) / 100, 2).' €' }}</span>
                    <span class="fw-bold">{{ number_format(($order->budget * $order->total_hours), 2).' €' }} </span>
                </div>
            </div>
        </div>
    </div>
@endsection
