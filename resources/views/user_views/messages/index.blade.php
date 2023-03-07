@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.messages') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12 mt-3 mb-4 d-flex justify-content-between flex-column flex-md-row">
                        <h2 class="mb-3 mb-md-0" style="font-family: 'Times New Roman', sans-serif">
                            {{ __('names.messages') }}
                        </h2>
                        <div class="d-flex flex-column flex-md-row gap-4">
                            {!! Form::open(['route' => ['deleteMessagesSetting', $prefix], 'method' => 'patch', 'class' => 'd-flex align-items-center gap-2', 'id' => 'deleteMessagesSetting']) !!}
                                <input type="checkbox" name="delete_messages" @if (auth()->user()->delete_messages) checked @endif
                                class="form-check-input specialist-checkbox" style="width: 20px; height: 20px">
                                <label for="delete_messages" class="fw-bold mt-1">
                                    {{ __('names.deleteMessagesSetting') }}
                                </label>
                            {!! Form::close() !!}
                            <a href="{{ route('messages.create', $prefix) }}" class="category-return-button px-4">
                                <i class="fa-solid fa-message fs-6 me-2"></i>
                                {{ __('names.sendMessage') }}
                            </a>
                            @if (count($unreadMessages) > 0)
                                {!! Form::open(['route' => ['markAllAsReadMessages', $prefix], 'method' => 'post']) !!}
                                    <button type="submit" class="category-return-button col-12 px-4">
                                        <i class="fa-solid fa-check me-2 fs-6"></i>
                                        {{ __('buttons.markAllAsRead') }}
                                    </button>
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col bg-white py-3 px-4">
                    <div id="description" class="tabs tabs-simple tabs-simple-full-width-line tabs-product tabs-dark mb-2">
                        <ul class="nav nav-tabs justify-content-start mb-0" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active py-2 px-3" href="#myMessages" data-bs-toggle="tab" aria-selected="true" role="tab">
                                    {{ __('names.myMessages') }}
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link nav-link-reviews py-2 px-3" href="#unreadMessages" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
                                    {{ __('names.unreadMessages') }}
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link py-2 px-3" href="#readMessages" data-bs-toggle="tab" aria-selected="true" role="tab">
                                    {{ __('names.readMessages') }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content p-0 pt-4">
                            <div class="tab-pane px-0 active" id="myMessages" role="tabpanel">
                                @include('user_views.messages.tables.my_messages_table')
                            </div>
                            <div class="tab-pane px-0" id="unreadMessages" role="tabpanel">
                                @include('user_views.messages.tables.unread_messages_table')
                            </div>
                            <div class="tab-pane px-0" id="readMessages" role="tabpanel">
                                @include('user_views.messages.tables.read_messages_table')
                            </div>
                        </div>
                    </div>
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
        const checkbox = document.querySelector('input[name="delete_messages"]')
        const form = document.getElementById('deleteMessagesSetting')

        const setCheckboxValue = () => checkbox.checked ? checkbox.value = true : checkbox.value = false

        checkbox.onchange = () => {
            setCheckboxValue()
            form.submit()
        }
    </script>
@endpush
