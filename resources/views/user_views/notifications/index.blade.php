@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.notifications')  }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 mt-3 mb-4 d-flex justify-content-between flex-column flex-md-row">
                        <h2 class="mb-0" style="font-family: 'Times New Roman', sans-serif">
                            {{ __('names.notifications') }}
                        </h2>
                        @if (count($unreadNotifications) > 0)
                            {!! Form::open(['route' => ['markAllAsRead', $prefix], 'method' => 'post']) !!}
                                <button type="submit" class="category-return-button px-4">
                                    <i class="fa-solid fa-check me-2 fs-6"></i>
                                    {{ __('buttons.markAllAsRead') }}
                                </button>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
                <div class="row d-flex flex-column gap-2 mx-0 bg-white p-4 mb-4">
                    <h5 class="p-0 m-0 mb-3">{{ __('names.unreadNotifications') }}</h5>
                    @forelse($unreadNotifications as $notification)
                        <div class="alert message fade-in d-flex justify-content-between flex-column flex-md-row gap-3 gap-md-0" role="alert">
                            <div class="d-flex align-items-center gap-3" style="color: #444">
                                <i class="fa-solid fa-circle-info fs-5"></i>
                                <div class="d-flex flex-column">
                                    <strong class="pt-1">{{ $notification->description }}</strong>
                                    <span class="text-muted">{{ $notification->created_at->format('H:m, F j') }}</span>
                                </div>
                            </div>
                            {!! Form::open(['route' => ['markAsRead', [$prefix, $notification->id]], 'method' => 'post']) !!}
                                <button type="submit" class="mark-as-read-button">
                                    <i class="fa-solid fa-check me-1"></i>
                                    {{ __('buttons.markAsRead') }}
                                </button>
                            {!! Form::close() !!}
                        </div>
                    @empty
                        <span class="text-muted p-0 m-0">{{ __('names.noNotifications') }}</span>
                    @endforelse
                    @if (count($unreadNotifications) > 10)
                        <div class="mt-4">
                            {{ $unreadNotifications->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
                <div class="row d-flex flex-column gap-2 mx-0 bg-white p-4">
                    <h5 class="p-0 m-0 mb-3">{{ __('names.readNotifications') }}</h5>
                    @forelse($readNotifications as $notification)
                        <div class="alert message fade-in d-flex justify-content-between flex-column flex-md-row gap-3 gap-md-0" role="alert">
                            <div class="d-flex align-items-center gap-3" style="color: #aaa">
                                <i class="fa-solid fa-circle-info fs-5"></i>
                                <strong class="pt-1">{{ $notification->description }}</strong>
                            </div>
                        </div>
                    @empty
                        <span class="text-muted p-0 m-0">{{ __('names.noNotifications') }}</span>
                    @endforelse
                    @if (count($readNotifications) > 10)
                        <div class="mt-4">
                            {{ $readNotifications->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .mark-as-read-button {
            border: none;
            background: none;
            font-weight: bold;
            transition: color 300ms ease;
        }

        .mark-as-read-button:hover,
        .mark-as-read-button:focus {
            color: #ffa600;
        }
    </style>
@endpush
