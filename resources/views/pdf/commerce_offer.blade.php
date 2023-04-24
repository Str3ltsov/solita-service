<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="lt-LT" xml:lang="lt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
        @if ($isCommerceOffer)
            {{ __('names.commerceOffer').' Nr. '.$order->id }}
        @else
            {{ __('names.vatInvoice').' Nr. '.$order->id }}
        @endif
    </title>
    <style>
        html {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }
        body {
            height: 100%;
            width: 100%;
            background: #eee;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
        }
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div style="display: flex; flex-direction: column; background: white; width: clamp(500px, 100%, calc(3508px / 4)); padding: 150px 50px 170px 50px; font-size: 13px">
        @if ($isCommerceOffer)
            <table style="margin-bottom: 100px">
                <tr>
                    <td style="font-style: italic; width: 290px">
                        <div style="display: flex; gap: 3px">
                            <b>{{ __('table.startDate') }}:</b>
                            <span>{{ $order->start_date ? $order->start_date->format('Y-m-d') : '' }}</span>
                        </div>
                        <div style="display: flex; gap: 3px">
                            <b>{{ __('table.startDate') }}:</b>
                            <span>{{ $order->end_date ? $order->end_date->format('Y-m-d') : '' }}</span>
                        </div>
                    </td>
                    <td style="width: 390px">
                        <h3 style="color: #555; text-transform: uppercase; font-size: 1.1rem">
                            {{ __('names.commerceOffer').' Nr. '.$order->id }}
                        </h3>
                    </td>
                </tr>
            </table>
        @else
            <table style="margin-bottom: 90px">
                <tr>
                    <td style="width: 680px; text-align: center">
                        <div style="font-size: 1.1rem; font-weight: bold">
                            {{ __('names.vatInvoice') }}
                        </div>
                        <div style="font-size: 1rem;">
                            {{ 'Nr. '.$order->id }}
                        </div>
                        <div style="font-size: 1rem;">
                            {{ now()->format('Y-m-d') }}
                        </div>
                    </td>
                </tr>
            </table>
        @endif
        <table style="margin-bottom: 50px">
            <tr>
                <td style="width: 400px">

                </td>
                <td style="width: 280px">
                    <span style="font-weight: 300; text-transform: uppercase; font-style: italic; font-size: 14px">
                        {{ __('names.customer') }}:
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="height: 1px; background: #888; margin-bottom: 15px"></div>
                </td>
            </tr>
            <tr>
                <td style="width: 400px; font-style: italic">
                    <div>
                        <b>UAB Solita</b>
                    </div>
                    <div>
                        <span>Taikos per. 88A, LT-51182 Kaunas</span>
                    </div>
                    <div>
                        <span>{{ __('names.companyCode') }}: 304764201</span>
                    </div>
                    <div>
                        <span>{{ __('names.vatCode') }}: LT100011832719</span>
                    </div>
                    <div>
                        <span>{{ __('forms.phone_number') }}: +370 37 247749</span>
                    </div>
                    <div>
                        <span>{{ __('names.billingAccount') }}: LT887180300034467248</span>
                    </div>
                    <div>
                        <span>{{ __('names.bank') }}: AB Šiaulių banko Vilniaus filialas</span>
                    </div>
                </td>
                <td style="width: 280px; display: flex; align-items: flex-start; font-style: italic">
                    <div>
                        <b>{{ $order->user->name ?? '' }}</b>
                    </div>
                    <div>
                        <span>
                            {{ $order->user->street ?? '' }}
                            {{ $order->user->house_flat ?? '' }}
                            {{ $order->user->post_index ?? '' }}
                            {{ $order->user->city ?? '' }}
                        </span>
                    </div>
                    <div>
                        <span>{{ $order->user->company_code ? __('names.companyCode').': '.$order->user->company_code : '' }}</span>
                    </div>
                    <div>
                        <span>{{ $order->user->vat_code ? __('names.vatCode').': '.$order->user->vat_code : '' }}</span>
                    </div>
                    <div>
                        <span>{{ $order->user->phone_number ? __('forms.phone_number').': +'.$order->user->phone_number : '' }}</span>
                    </div>
                </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
            <tr style="background: #555; text-transform: uppercase; color: white; text-align: center">
                <td style="border: 1px solid #777; padding: 8px;">{{ __('table.name') }}</td>
                <td style="border: 1px solid #777; padding: 8px;">{{ __('names.quantity') }}</td>
                <td style="border: 1px solid #777; padding: 8px;">{{ __('table.price') }}</td>
                <td style="border: 1px solid #777; padding: 8px;">{{ __('table.total') }}</td>
                <td style="border: 1px solid #777; padding: 8px;">{{ __('names.vat') }}</td>
            </tr>
            </thead>
            <tbody>
            <tr style="text-align: center">
                <td style="border: 1px solid #777; padding: 9px;">{{ $order->name }}</td>
                <td style="border: 1px solid #777; padding: 9px;">{{ $order->total_hours.' '.__('names.shortPerHour') }}</td>
                <td style="border: 1px solid #777; padding: 9px;">{{ number_format($order->budget, 2).' €' }}</td>
                <td style="border: 1px solid #777; padding: 9px;">{{ number_format(($order->budget * $order->total_hours), 2).' €' }}</td>
                <td style="border: 1px solid #777; padding: 9px;">{{ number_format(($order->budget * $order->total_hours * 21) / 100, 2).' € (21.00%)' }}</td>
            </tr>
            </tbody>
        </table>
        <table style="float: right; margin-top: 40px">
            <tr>
                <td style="letter-spacing: 4px; width: 100px; text-align: right; padding-right: 30px">
                    <div style="text-transform: uppercase; padding: 3px 0">{{ __('table.total') }}</div>
                    <div style="text-transform: uppercase; padding: 3px 0">{{ __('names.vat') }}</div>
                    <div style="padding: 3px 0">
                        <b>{{ __('names.absoluteTotal') }}</b>
                    </div>
                </td>
                <td style="text-align: right; padding-right: 30px">
                    <div style="padding: 3px 0">
                        {{ number_format((($order->budget * $order->total_hours) - ($order->budget * $order->total_hours * 21) / 100), 2).' €' }}
                    </div>
                    <div style="padding: 3px 0">
                        {{ number_format(($order->budget * $order->total_hours * 21) / 100, 2).' €' }}
                    </div>
                    <div style="padding: 3px 0">
                        <b>{{ number_format(($order->budget * $order->total_hours), 2).' €' }}</b>
                    </div>
                </td>
            </tr>
        </table>
        @if ($isCommerceOffer)
            <div style="margin-top: 130px;">
                {{ __('names.send20%part1').' ('.number_format(($order->budget * $order->total_hours * 20) / 100, 2).' Eur) '.__('names.send20%part2') }}
            </div>
        @endif
    </div>
{{--    <div class="d-flex flex-column bg-white overflow-scroll" style="width: clamp(500px, 100%, calc(3508px / 4)); padding: 150px 50px 300px 50px">--}}
{{--        <div class="d-flex align-items-center justify-content-between">--}}
{{--            <div class="d-flex flex-column fst-italic col-6" style="line-height: 22px">--}}
{{--                <div class="d-flex gap-1">--}}
{{--                    <b>{{ __('table.startDate') }}:</b>--}}
{{--                    <span>{{ $order->start_date ? $order->start_date->format('Y-m-d') : '' }}</span>--}}
{{--                </div>--}}
{{--                <div class="d-flex gap-1">--}}
{{--                    <b>{{ __('table.startDate') }}:</b>--}}
{{--                    <span>{{ $order->end_date ? $order->end_date->format('Y-m-d') : '' }}</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="d-flex align-items-end col-6">--}}
{{--                <h4 class="text-uppercase" style="font-family: Cambria, Georgia, serif; color: #666">--}}
{{--                    {{ __('names.commerceOffer').' #'.$order->id }}--}}
{{--                </h4>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="mt-5 mb-3 pt-5 d-flex" style="border-bottom: 1px #999 solid">--}}
{{--            <div class="col-8"></div>--}}
{{--            <div class="col-auto">--}}
{{--                <span class="text-uppercase fs-6 fst-italic" style="font-weight: 300">{{ __('names.client') }}:</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="d-flex justify-content-between w-100 fst-italic" style="line-height: 18px">--}}
{{--            <div class="d-flex flex-column gap-1 col-8">--}}
{{--                <b>UAB Solita</b>--}}
{{--                <span>Taikos per. 88A, LT-51182 Kaunas</span>--}}
{{--                <span>{{ __('names.companyCode') }}: 304764201</span>--}}
{{--                <span>{{ __('names.vatCode') }}: LT100011832719</span>--}}
{{--                <span>{{ __('forms.phone_number') }}: +370 37 247749</span>--}}
{{--            </div>--}}
{{--            <div class="d-flex flex-column gap-1 col-4">--}}
{{--                <b>{{ $order->user->name ?? '' }}</b>--}}
{{--                <span>--}}
{{--                        {{ $order->user->street ?? '' }}--}}
{{--                    {{ $order->user->house_flat ?? '' }}@if ($order->user->post_index !== null),@endif--}}
{{--                    {{ $order->user->post_index ?? '' }}--}}
{{--                    {{ $order->user->city ?? '' }}--}}
{{--                    </span>--}}
{{--                <span>{{ $order->user->phone_number && __('forms.phone_number').': +'.$order->user->phone_number }}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="d-flex align-items-center justify-content-center mt-5">--}}
{{--            <table class="table table-bordered table-responsive overflow-scroll">--}}
{{--                <thead>--}}
{{--                <tr class="text-uppercase text-white text-center bg-dark" style="background: #555">--}}
{{--                    <td>{{ __('table.name') }}</td>--}}
{{--                    <td>{{ __('names.quantity') }}</td>--}}
{{--                    <td>{{ __('table.price') }}</td>--}}
{{--                    <td>{{ __('table.total') }}</td>--}}
{{--                    <td>{{ __('names.vat') }}</td>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                <tr style="font-family: Calibri, serif">--}}
{{--                    <td class="text-center">{{ $order->name }}</td>--}}
{{--                    <td class="text-center">{{ $order->total_hours.' '.__('names.shortPerHour') }}</td>--}}
{{--                    <td class="text-center">{{ number_format($order->budget, 2) }}</td>--}}
{{--                    <td class="text-center">{{ number_format(($order->budget * $order->total_hours), 2) }}</td>--}}
{{--                    <td class="text-center">{{ number_format(($order->budget * $order->total_hours * 21) / 100, 2).' (21.00%)' }}</td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--        <div class="d-flex justify-content-between align-items-center mt-5">--}}
{{--            <div class="col-auto col-md-7">--}}
{{--            </div>--}}
{{--            <div class="col-md-5 d-flex justify-content-end gap-4">--}}
{{--                <div class="d-flex flex-column align-items-end" style="letter-spacing: 4px">--}}
{{--                    <span class="text-uppercase">{{ __('table.total') }}</span>--}}
{{--                    <span class="text-uppercase">{{ __('names.vat') }}</span>--}}
{{--                    <span class="fw-bold">{{ __('names.absoluteTotal') }}</span>--}}
{{--                </div>--}}
{{--                <div class="d-flex flex-column align-items-end">--}}
{{--                    <span>{{ number_format($order->budget, 2).' €' }}</span>--}}
{{--                    <span>{{ number_format(($order->budget * $order->total_hours * 21) / 100, 2).' €' }}</span>--}}
{{--                    <span class="fw-bold">{{ number_format(($order->budget * $order->total_hours), 2).' €' }} </span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</body>
</html>
