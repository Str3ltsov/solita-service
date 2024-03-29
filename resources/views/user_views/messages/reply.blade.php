@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ route('messages.index', $prefix) }}">
                {{ __('names.messages') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ route('messages.show', [$prefix, $message->id]) }}">
                {{ $message->topic }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.replyToMessage') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12 mt-3 mb-4 d-flex justify-content-between flex-column flex-md-row">
                        <h2 class="mb-3 mb-md-0">
                            {{ __('names.replyToMessage').': '.$message->topic }}
                        </h2>
                        <div class="d-flex flex-column flex-md-row gap-4">
                            <a href="{{ url()->previous() }}" class="category-return-button px-4">
                                <i class="fa-solid fa-chevron-left me-2 fs-6"></i>
                                {{ __('buttons.back') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row d-flex flex-column gap-2 mx-0 bg-white px-3 py-4 mb-4 border-around">
                    @include('user_views.messages.forms.reply_form')
                </div>
            </div>
        </div>
    </div>
@endsection
