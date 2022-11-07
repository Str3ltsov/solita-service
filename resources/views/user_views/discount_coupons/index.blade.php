@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.discountCoupons') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            {{--<h3 style="font-family: 'Times New Roman', sans-serif">{{__('names.discountCoupons')}}</h3>--}}
            <div class="col-lg-12 mt-3">
                <div class="row">
                    @forelse( $discountCoupons as $prod )
                        <div class="col-lg-6 col-md-12">
                            <div class="bg-white p-4 mb-4">
                                <h5>{{__('names.discountCouponCode')}}: {{$prod->code}}</h5>
                                <h6>{{__('names.discountCouponValue')}}: {{number_format($prod->value,2)}} EU</h6>
                            </div>
                        </div>
                    @empty
                        <span class="text-muted">{{ __('names.ndDiscountCoupons') }}</span>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center mt-4">
                    @if (!empty($discountCoupons->count()))
                        {{ $discountCoupons->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
