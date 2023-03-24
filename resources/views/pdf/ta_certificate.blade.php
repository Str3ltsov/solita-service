<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="lt-LT" xml:lang="lt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ __('names.taCertificate').' #'.$order->id }}</title>
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
<div style="display: flex; flex-direction: column; background: white; width: clamp(500px, 100%, calc(3508px / 4)); padding: 30px 95px; font-size: 13px">
    <h3 style="text-align: center">{{ __('PERDAVIMO-PRIĖMIMO AKTAS') }}</h3>
    <p style="text-align: center">{{ now()->format('Y-m-d') }}</p>
    <p style="margin-top: 30px">{{ __("Mes, pasirašiusieji šį aktą, patvirtiname, kad pagal komercinį pasiūlymą Nr. {$order->id} UAB „Solita“ suteikė, o UAB „{$customer->name}“ priėmė šias komerciniame pasiūlyme numatytas paslaugas: „{$order->name}“.") }}</p>
    <table style="width: 100%; margin-top: 50px">
        <tr>
            <td style="width: 50%; vertical-align: top">
                <div><b>Užsakovas</b></div>
                <div>UAB „{{ $customer->name ?? '' }}“</div>
                <div>
                    <span>
                        {{ $customer->street ?? '' }}
                        {{ $customer->house_flat ?? '' }}
                        {{ $customer->post_index ?? '' }}
                        {{ $customer->city ?? '' }}
                    </span>
                </div>
                <div>Įmonės kodas: {{ $customer->company_code ?? '' }}</div>
                <div>PVM kodas: {{ $customer->vat_code ?? '' }}</div>
                <div>Tel. Nr.: {{ $customer->phone_number ?? '' }}</div>
                <div>E-paštas: {{ $customer->email ?? '' }}</div>
            </td>
            <td style="width: 50%; vertical-align: top">
                <div><b>Paslaugų teikėjas</b></div>
                <div>UAB „Solita“</div>
                <div>Taikos pr. 88A, LT-51182 Kaunas</div>
                <div>Įmonės kodas 304764201</div>
                <div>PVM mokėtojo kodas LT100011832719</div>
                <div>Tel. Nr.: +370 37 247749</div>
                <div>E-paštas: info@solita.lt</div>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top">
                <br>
                <div>Direktorius</div>
                <div></div>
            </td>
            <td style="vertical-align: top">
                <br>
                <div>Direktorė</div>
                <div>Asta Radziukynaitė</div>
            </td>
        </tr>
        <tr>
            <td style="font-size: .55rem; text-align: center;">
                <br><br><br>
                <div style="border-top: 1px solid #222; width: 82.5%">(parašas)</div>
            </td>
            <td style="font-size: .55rem; text-align: center;">
                <br><br><br>
                <div style="border-top: 1px solid #222; width: 82.5%">(parašas)</div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
