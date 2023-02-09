@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/rootcategories") }}">
                {{ __('menu.categories') ?? '' }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $maincategory->name ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <aside class="sidebar px-4 pt-2 pb-4">
                    <h4 class="sidebar-title">{{ __('names.categories')}}</h4>
                    @include('user_views.category.categoryTree')
                </aside>
            </div>
            <div class="col-lg-9">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4 mt-4 mt-lg-0 gap-3">
                    <div>
                        <h4 class="mb-1 mb-lg-0" style="font-family: 'Times New Roman', sans-serif">{{ $maincategory->name }}</h4>
                        <p class="m-0 p-0 mb-2 mt-3">{{ $maincategory->description }}</p>
                        <div class="d-flex flex-column flex-sm-row gap-0 gap-sm-3 mb-2">
                            <div class="d-flex gap-1">
                                <span class="text-muted">{{ __('table.created_at') }}:</span>
                                <span>{{ $maincategory->created_at ? $maincategory->created_at->format('Y-m-d') : '-'}}</span>
                            </div>
                            <div class="d-flex gap-1">
                                <span class="text-muted">{{ __('table.updated_at') }}:</span>
                                <span>{{ $maincategory->updated_at ? $maincategory->updated_at->format('Y-m-d') : '-'}}</span>
                            </div>
                        </div>
                        <div class="text-muted">
                            {{ __('names.showing') }}
                            @if ($products->currentPage() !== $products->lastPage())
                                {{ ($products->count() * $products->currentPage() - $products->count() + 1).__('–').($products->count() * $products->currentPage()) }}
                            @else
                                @if ($products->total() - $products->count() === 0)
                                    {{ $products->count() }}
                                @else
                                    {{ ($products->total() - $products->count()).__('–').$products->total() }}
                                @endif
                            @endif
                            {{ __('names.of') }}
                            {{ $products->total().' '.__('names.entries') }}
                        </div>
                    </div>
                    <a href="{{ url("/rootcategories") }}" class="category-return-button col-xl-4 col-lg-5 col-md-5">
                        {{ __('buttons.backToMainCategories') }}
                    </a>
                </div>
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6 mt-4 mt-md-0 mt-lg-0 mb-5">
                            @include('user_views.product.products_grid')
                        </div>
                    @empty
                        <span class="text-muted">{{ __('names.noProducts') }}</span>
                    @endforelse
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
