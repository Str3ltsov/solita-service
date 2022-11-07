@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('names.dashboard') }} <br/>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('names.loggedIn') }}<br/>{{__('names.language')}} {{$lang}}
                    </div>
                    <div class="card-body flex">
                        @if($messages)
                            <div class="row justify-content-center mt-2 p-2 text-center">
                                <h5 class="card-subtitle mb-2 text-muted">{{__('names.youHave')}} {{$messages}} {{__('names.unreadMsg')}}</h5>
                                <a href="/user/messenger">{{__('names.openMsg')}}</a>
                            </div>
                        @endif
                        <div class="row justify-content-center mt-2 p-2">
                            <div class="card p-2">
                                <h3>{{__('names.myCart')}}</h3>
                                @if($cartItems)
                                    <h5 class="card-subtitle mb-2 text-muted">{{__('names.displayingCartItems')}}</h5>
                                    <div class="d-flex justify-content-center">
                                        @foreach($cartItems as $item)
                                            <div class="col-md m-1">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{__('names.productName')}}
                                                            : {{$item->product->name}}</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">{{__('names.addedAt')}}
                                                            : {{$item->created_at}}</h6>
                                                        <p>{{__('names.description')}}
                                                            : {{$item->product->description}} </p>
                                                        <p>{{__('names.pricePerItem')}}: {{$item->price_current}}
                                                            €<br/>{{__('names.quantity')}}: {{$item->count}} </p>
                                                        <a href="{{ route('viewproduct', [$item->product_id]) }}">
                                                            {{__('names.viewProduct')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="card-text">{{__('names.noProductsInCart')}}</p>
                                @endif
                                <span>
                                    @if($cartItems)
                                        <a href="/user/viewcart" class="card-link">{{__('names.viewCart')}}</a>
                                    @endif
                                        <a href="/user/products" class="card-link">{{__('names.browseProducts')}}</a>
                                </span>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-2 p-2">
                            <div class="card p-2">
                                <h3>{{__('names.myOrders')}}</h3>
                                @if($orders)
                                    <h5 class="card-subtitle mb-2 text-muted">{{__('names.displayingOrders')}}</h5>
                                    <div class="d-flex justify-content-center">
                                        @foreach($orders as $order)
                                            <div class="col-md m-1">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Status: {{$order->status->name}}</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">{{__('names.createdAt')}}
                                                            : {{$order->created_at}}</h6>
                                                        <p>{{__('names.sum')}}: {{$order->sum}} </p>
                                                        <a href="{{ route('vieworder', [$order->id]) }}">{{__('names.viewOrder')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <h5 class="card-text">{{__('names.noOrders')}}</h5>
                                @endif
                                <span>
                                    @if($orders)
                                        <a href="/user/rootorders" class="card-link">{{__('names.viewAllOrders')}}</a>
                                    @endif
                                        <a href="/user/products" class="card-link">{{__('names.browseProducts')}}</a>
                                </span>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-2 p-2">
                            <div class="card p-2">
                                <h3>{{__('names.myReturns')}}</h3>
                                @if($returns)
                                    <h5 class="card-subtitle mb-2 text-muted">{{__('names.displayingReturns')}}</h5>
                                    <div class="d-flex justify-content-center">
                                        @foreach($returns as $return)
                                            <div class="col-md m-1">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{__('names.code')}}
                                                            : {{$return->code}}</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">{{__('names.createdAt')}}
                                                            : {{$order->created_at}}</h6>
                                                        <p>{{__('names.description')}}: {{$return->description}} </p>
                                                        <a href="{{ route('viewreturn', [$return->id]) }}">{{__('names.viewReturn')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <h5 class="card-text">{{__('names.noReturns')}}</h5>
                                @endif
                                <span>
                                    @if($returns)
                                        <a href="/user/rootoreturns"
                                           class="card-link">{{__('names.viewAllReturns')}}</a>
                                    @endif
                                    <a href="/user/products" class="card-link">{{__('names.browseProducts')}}</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
