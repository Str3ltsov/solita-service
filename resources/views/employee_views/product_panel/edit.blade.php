@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container px-sm-0">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url('/employee/product_panel') }}">
                {{ __('menu.productPanel') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.editProduct') }}
            </span>
        </div>
    </div>
    <div class="container px-sm-0">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mt-3 mb-4">
                    <h3 class="mb-4 mb-md-0" style="font-family: 'Times New Roman', sans-serif">
                        {{ __('names.editProduct') }}
                    </h3>
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <a href="{{ url('/employee/product_panel') }}"
                           class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-arrow-left fs-6 me-2"></i>
                            {{ __('buttons.back') }}
                        </a>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3 ps-4 py-4">
                    {!! Form::model($product, ['route' => ['product_panel.update', $product->id], 'method' => 'patch', 'files' => true, 'class' => 'row px-0']) !!}
                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group col-12 mb-3">
                                {!! Form::label("name_$locale", ''.__('table.name').' '.strtoupper($locale)) !!}
                                {!! Form::text("name_$locale", ( isset($product) && isset($product->translate($locale)->name) ? $product->translate($locale)->name : null ) , ['class' => 'form-control', 'style' => 'border-radius: 0']) !!}
                            </div>
                            <div class="form-group col-12 mb-3">
                                {!! Form::label("description_$locale", ''.__('table.description').' '.strtoupper($locale)) !!}
                                {!! Form::textarea("description_$locale",  ( isset($product) && isset($product->translate($locale)->description) ? $product->translate($locale)->description : null ), ['class' => 'form-control', 'rows' => 3, 'style' => 'border-radius: 0']) !!}
                            </div>
                        @endforeach
                        <div class="form-group col-md-3 col-6 mb-3">
                            {!! Form::label('price', __('table.price').' (€)') !!}
                            {!! Form::number('price', $product->price, ['class' => 'form-control', 'step' => '0.01', 'style' => 'border-radius: 0']) !!}
                        </div>
                        <div class="form-group col-md-3 col-6 mb-3">
                            {!! Form::label('count', __('table.count')) !!}
                            {!! Form::number('count', $product->count, ['class' => 'form-control', 'style' => 'border-radius: 0']) !!}
                        </div>
                        <div class="form-group col-md-3 col-6 mb-3">
                            {!! Form::label('delivery_time', __('table.deliveryTime')) !!}
                            {!! Form::number('delivery_time', null, ['class' => 'form-control', 'style' => 'border-radius: 0']) !!}
                        </div>
                        <div class="form-group col-md-3 col-12 mb-3">
                            {!! Form::label('visible', __('table.visible')) !!}
                            {!! Form::select('visible', $visibilityList, $product->visible, ['class' => 'form-control custom-select', 'style' => 'border-radius: 0']) !!}
                        </div>
                        <div class="form-group col-md-6 col-12 mb-3">
                            {!! Form::label('image',__('table.image')) !!}
                            {!! Form::file('image', ['class' => 'form-control', 'style' => 'border-radius: 0']) !!}
                        </div>
                        <div class="form-group col-md-6 col-12 mb-3">
                            {!! Form::label('categories', __('table.categories')) !!}
                            {!! Form::select('categories[]', $categories, null, ['class' => 'form-control custom-select', 'multiple'=>'multiple','name'=>'categories[]', 'size' => 3, 'style' => 'border-radius: 0']) !!}
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-4 col-12">
                            <button type="submit" class='btn btn-primary orders-returns-primary-button col-lg-4 col-md-6 col-12'>
                                {{ __('buttons.save') }}
                            </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
