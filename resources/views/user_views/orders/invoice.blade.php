<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="d-block w-100 h-100">
<div class="card">
    <div class="card-body">
        <div class="container mb-5 mt-3">
            <div class="container flex-grow-1">
                <div class="col-md-12">
                    <div class="text-center">
                        <i class="far fa-building fa-4x ms-0" style="color:#8f8061 ;"></i>
                        <p class="pt-2">AURINTUS.LT</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8">
                        <ul class="list-unstyled">
                            <li class="text-muted"><b>{{__('forms.to')}}:</b> <span
                                    style="color:#8f8061 ;">{{$order->user->name}}</span></li>
                            <li class="text-muted"><b>{{__('forms.street')}}, {{__('forms.city')}} :</b> {{$order->user->street}}
                                , {{$order->user->city}}</li>
                            <li class="text-muted"><b>{{__('forms.house_flat')}}:</b> {{$order->user->house_flat}}</li>
                            <li class="text-muted"><i class="fas fa-phone"></i> {{$order->user->phone_number}}</li>
                        </ul>
                    </div>
                    <div class="col-xl-4 ">
                        <p class="text-muted">{{__('names.invoice')}}</p>
                        <ul class="list-unstyled">
                            <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                                    class="fw-bold">{{__('table.orderId')}}:</span> {{ $order->id }}
                            </li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                                    class="fw-bold">{{__('table.created_at')}}: </span> {{$order->created_at}}
                            </li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061;"></i> <span
                                    class="me-1 fw-bold">{{__('table.status')}}:</span>
                                @if($order->status->name == 'New' || $order->status->name == "Waiting")
                                    <span class="badge bg-warning text-black fw-bold">{{$order->status->name}}</span>
                                @elseif($order->status->name == "Canceled" || $order->status->name == "Returned")
                                    <span class="badge bg-danger text-white fw-bold">{{$order->status->name}}</span>
                                @else
                                    <span class="badge bg-success text-white fw-bold">{{$order->status->name}}</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <hr/>
                @foreach($orderItems as $orderItem)
                    <div class="row my-2 mx-1 justify-content-center">
                        <div class="col-md-2 mb-4 mb-md-0 mb col-sm-3">
                            <div class="
                        bg-image
                        ripple
                        rounded-5
                        overflow-hidden
                        d-block
                        " data-ripple-color="light">
{{--                                <img--}}
{{--                                    class="img-fluid"--}}
{{--                                    width="150"--}}
{{--                                    height="150"--}}
{{--                                    src="{{$orderItem->product->image ? $orderItem->product->image : 'https://t4.ftcdn.net/jpg/04/00/24/31/360_F_400243185_BOxON3h9avMUX10RsDkt3pJ8iQx72kS3.jpg'}}"--}}
{{--                                    alt="{{$orderItem->product->name}}--}}
{{--                                    "/>--}}

                            </div>
                        </div>
                        <div class="col-md-7 mb-4 mb-md-0">
                            <p class="fw-bold">{{ $orderItem->product->name}}</p>
                            <p class="mb-1">
                                    <span
                                        class="text-muted me-2">{{__('table.description')}}: </span><span>{{$orderItem->product->description}}</span>
                            </p>
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0 my-md-4 align-items-md-center justify-content-md-center">
                            <h5 class="mb-2">
                                <span
                                    class="align-middle"><b>{{__('table.price')}}:</b> {{ number_format($orderItem->price_current,2)}} € x {{$orderItem->count}}</span>
                            </h5>
                        </div>
                    </div>
                @endforeach
                <hr>
                <div class="row">
{{--                    <div class="col-xl-8">--}}
{{--                        <p class="ms-3">PLACEHOLDER FOR ADDITIONAL NOTES AND PAYMENT INFO</p>--}}
{{--                    </div>--}}
                    <div class="col-xl-3">
{{--                        <ul class="list-unstyled">--}}
{{--                            <li class="text-muted ms-3"><span class="text-black me-4">{{__('table.subTotal')}}</span> BEFORE SHIPPING--}}
{{--                            </li>--}}
{{--                            <li class="text-muted ms-3 mt-2"><span class="text-black me-4">{{__('table.shipping')}}</span> INCLUDE PRICE--}}
{{--                                HERE--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        {{ number_format((float)$order->sum, 2, '.', '') }}--}}
                        <p class="text-black float-start"><span class="text-black me-3"> {{__('table.sum')}}</span><span
                                style="font-size: 25px;"> {{ number_format($order->sum,2) }} €</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
