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
            <a href="{{ url("/user/vieworder/$order->id") }}">
                {{ $order->id ?? '' }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('buttons.return') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12 d-flex flex-column gap-4">
                <div class="mb-4 mt-3" style="font-family: 'Times New Roman', sans-serif">
                    <h3>{{__("names.return")}}: {{ $order->id }}</h3>
                </div>
                <div class="row bg-white mx-md-0 p-3">
                    <h5 class="mt-2 mb-4">{{ __('names.products') }}</h5>
                    {!! Form::model($order, ['route' => ['savereturnorder', $order->id], 'method' => 'post']) !!}
                        <div class="table table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead style="background: #e7e7e7;">
                                <tr>
                                    <th class="text-center">{{__('names.checkReturn')}}</th>
                                    <th>{{__('table.productId')}}</th>
                                    <th>{{__('table.productName')}}</th>
                                    <th>{{__('table.price')}}</th>
                                    <th>{{__('table.count')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orderItems as $item)
                                    <tr>
                                        <td class="text-center">
                                            {!! Form::checkbox("return_items[]", $item->product_id, false, ['class' => 'form-check-input']) !!}
                                        </td>
                                        <td>{{ $item->product_id }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->price_current }} €</td>
                                        <td>{{ $item->count }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::label('description', __('names.desc'), ['class' => 'fs-6 mb-2']) !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'style' => 'border-color: lightgray; border-radius: 0']) !!}
                        </div>
                        <div class="form-group col-sm-12 d-flex flex-column flex-md-row justify-content-md-center align-items-sm-center gap-3 my-4">
                            {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary orders-returns-primary-button col-lg-3 col-md-4 col-sm-12']) !!}
                            <a href="{{ route('rootorders') }}" class="btn btn-secondary orders-returns-secondary-button col-lg-3 col-md-4 col-sm-12">
                                {{__('buttons.cancel')}}
                            </a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

