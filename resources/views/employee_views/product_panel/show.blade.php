@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url('/employee/product_panel') }}">
                {{ __('menu.productPanel') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $product->id }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mt-3 mb-4">
                    <h3 class="mb-4 mb-md-0">
                        {{ __('names.product') }}: {{ $product->id }}
                    </h3>
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <a href="{{ url('/employee/product_panel') }}"
                           class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-arrow-left fs-6 me-2"></i>
                            {{ __('buttons.back') }}
                        </a>
                        <a href="{{ route('product_panel.edit', [$product->id]) }}"
                           class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-pen-to-square fs-6 me-2"></i>
                            {{ __('buttons.edit') }}
                        </a>
                        {!! Form::open(['route' => ['product_panel.destroy', $product->id], 'method' => 'delete']) !!}
                            <button type="submit" class='btn btn-primary orders-returns-primary-button'
                               onclick="return confirm('{{ __('messages.areYouSureDeleteProduct') }}?')">
                                <i class="fa-solid fa-trash-can fs-6 me-2"></i>
                                {{ __('buttons.delete') }}
                            </button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3 py-4 border-around">
                    <div class="col-md-6 col-12 mb-4 mb-md-0">
                        <img src="@if ($product->image) {{ $product->image }} @else {{ asset('images/noimage.jpeg') }} @endif" alt="product_image" class="w-100">
                    </div>
                    <div class="col-md-6 col-12 d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between col-12">
                            <span class="fw-bold fs-6">{{ __('table.name') }}:</span>
                            <span class="fs-6">{{ $product->name }}</span>
                        </div>
                        <div class="d-flex justify-content-between col-12">
                            <span class="fw-bold fs-6">{{ __('table.price') }}:</span>
                            <span class="fs-6">
                                @if ($product->discount_id)
                                    €{{ $product->price - (($product->price / 100) * $product->discount->proc) }}
                                    <strike class="text-muted ms-1">€{{ $product->price }}</strike>
                                @else
                                    €{{ $product->price }}
                                @endif
                            </span>
                        </div>
                        <div class="d-flex justify-content-between col-12">
                            <span class="fw-bold fs-6">{{ __('table.visible') }}:</span>
                            <span class="fs-6">{{ $product->visible ? __('names.true') : __('names.false') }}</span>
                        </div>
{{--                        <div class="d-flex justify-content-between col-12">--}}
{{--                            <span class="fw-bold fs-6">{{ __('table.specialist') }}:</span>--}}
{{--                            <span class="fs-6">{{ $product->is_for_specialist ? __('names.true') : __('names.false') }}</span>--}}
{{--                        </div>--}}
                        <div class="d-flex justify-content-between col-12">
                            <span class="fw-bold fs-6">{{ __('names.categories') }}:</span>
                            <span class="fs-6">
                                @forelse ($product->categories as $category)
                                    <span>{{ $category->name }}</span>
                                @empty
                                    <span>-</span>
                                @endforelse
                            </span>
                        </div>
                        <div class="d-flex justify-content-between col-12">
                            <span class="fw-bold fs-6">{{ __('table.created_at') }}:</span>
                            <span class="fs-6">{{ $product->created_at->format('Y-m-d H:m') }}</span>
                        </div>
                        <div class="d-flex justify-content-between col-12">
                            <span class="fw-bold fs-6">{{ __('table.updated_at') }}:</span>
                            <span class="fs-6">{{ $product->updated_at->format('Y-m-d H:m') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
