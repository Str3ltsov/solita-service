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
                        <h2 class="mb-3 mb-md-0" style="font-family: 'Times New Roman', sans-serif">
                            {{ __('names.notifications') }}
                        </h2>
                        <div class="d-flex flex-column flex-md-row gap-4">
                            {!! Form::open(['route' => ['deleteNotificationsSetting', $prefix], 'method' => 'patch', 'class' => 'd-flex align-items-center gap-2', 'id' => 'deleteNotificationsSetting']) !!}
                                <input type="checkbox" name="delete_notifications" @if (auth()->user()->delete_notifications) checked @endif
                                class="form-check-input specialist-checkbox" style="width: 20px; height: 20px">
                                <label for="delete_notifications" class="fw-bold mt-1">
                                    {{ __('names.deleteNotificationsSetting') }}
                                </label>
                            {!! Form::close() !!}
                            @if (count($unreadNotifications) > 0)
                                {!! Form::open(['route' => ['markAllAsRead', $prefix], 'method' => 'post']) !!}
                                    <button type="submit" class="category-return-button w-100 px-4">
                                        <i class="fa-solid fa-check me-2 fs-6"></i>
                                        {{ __('buttons.markAllAsRead') }}
                                    </button>
                                {!! Form::close() !!}
                            @endif
                        </div>
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
                            <div class="d-flex flex-column justify-content-center align-items-center gap-1">
                                {!! Form::open(['route' => ['markAsRead', [$prefix, $notification->id]], 'method' => 'post']) !!}
                                    <button type="submit" class="mark-as-read-button">
                                        <i class="fa-solid fa-check me-1"></i>
                                        {{ __('buttons.markAsRead') }}
                                    </button>
                                {!! Form::close() !!}
                                {!! Form::open(['route' => ['deleteNotification', [$prefix, $notification->id]], 'method' => 'delete']) !!}
                                    <button type="submit" class="mark-as-read-button" onclick="return confirm('{{ __('messages.areYouSureDeleteNotification') }}')">
                                        <i class="fa-solid fa-trash-can me-2"></i>
                                        {{ __('buttons.deleteNotification') }}
                                    </button>
                                {!! Form::close() !!}
                            </div>
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
                                <div class="d-flex flex-column">
                                    <strong class="pt-1">{{ $notification->description }}</strong>
                                    <span>{{ $notification->created_at->format('H:m, F j') }}</span>
                                </div>
                            </div>
                            {!! Form::open(['route' => ['deleteNotification', [$prefix, $notification->id]], 'method' => 'delete']) !!}
                                <button type="submit" class="mark-as-read-button" onclick="return confirm('{{ __('names.areYouSureDeleteNotification') }}')">
                                    <i class="fa-solid fa-trash-can me-2"></i>
                                    {{ __('buttons.deleteNotification') }}
                                </button>
                            {!! Form::close() !!}
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

@push('scripts')
    <script>
        const checkbox = document.querySelector('input[name="delete_notifications"]')
        const form = document.getElementById('deleteNotificationsSetting')

        const setCheckboxValue = () => checkbox.checked ? checkbox.value = true : checkbox.value = false

        checkbox.onchange = () => {
            setCheckboxValue()
            form.submit()
        }
    </script>
@endpush
