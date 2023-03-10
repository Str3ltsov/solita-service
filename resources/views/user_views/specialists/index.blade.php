@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.specialists')  }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 mt-3 mb-4">
                        <h2 class="mb-0">
                            {{ __('names.specialists') }}
                        </h2>
                        <div class="text-muted mb-2 mb-lg-0">
                            {{ __('names.showing') }}
                            @if ($specialists->currentPage() !== $specialists->lastPage())
                                {{ ($specialists->count() * $specialists->currentPage() - $specialists->count() + 1).__('–').($specialists->count() * $specialists->currentPage()) }}
                            @else
                                @if ($specialists->total() - $specialists->count() === 0)
                                    {{ $specialists->count() }}
                                @else
                                    {{ ($specialists->total() - $specialists->count()).__('–').$specialists->total() }}
                                @endif
                            @endif
                            {{ __('names.of') }}
                            {{ $specialists->total().' '.__('names.entries') }}
                        </div>
                    </div>
                </div>
                <div class="row d-flex flex-column gap-4 mx-0">
                    @include('user_views.specialists.specialist_list')
                </div>
                @if (count($specialists) > 0)
                    <div class="mt-4">
                        {{ $specialists->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
