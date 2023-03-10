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
            <span>
                {{ $message->topic }}
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
                            {{ __('names.message').': '.$message->topic }}
                        </h2>
                        <div class="d-flex flex-column flex-md-row gap-4">
                            <a href="{{ route('messages.index', $prefix) }}" class="category-return-button px-4">
                                <i class="fa-solid fa-chevron-left me-2 fs-6"></i>
                                {{ __('buttons.back') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col bg-white p-4 border-around"">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column flex-md-row gap-md-3 flex-wrap mt-2">
                            @foreach($message->messageUsers as $messageUser)
                                @if ($message->sender_id != auth()->user()->id && $messageUser->user_id == auth()->user()->id && $messageUser->marked_as_read)
                                    <h6>
                                        <i class="fa-solid fa-check fs-6 me-1"></i>
                                        {{ __('names.markedAsRead') }}
                                    </h6>
                                    <div style="height: 1px; width: 100%; background: #ccc; margin-bottom: 15px">.</div>
                                @endif
                            @endforeach
                        </div>
                        <h5>{{ $message->topic }}</h5>
                        <div class="d-flex flex-column flex-md-row gap-1 flex-wrap">
                            <div class="d-flex flex-column flex-lg-row gap-lg-3 me-3">
                                <div class="d-flex gap-1">
                                    <span>{{ __('names.from') }}:</span>
                                    <span class="fw-bold">{{ $message->user->name }}</span>
                                </div>
                                <div class="d-flex gap-1">
                                    <span>{{ __('names.sentTo') }}:</span>
                                    <span class="fw-bold">
                                        @forelse($message->messageUsers as $messageUser)
                                            {{ $messageUser->user->name }}@if (!$loop->last),@endif
                                        @empty
                                        @endforelse
                                    </span>
                                </div>
                                <div class="d-flex gap-1">
                                    <span>{{ __('names.order') }}:</span>
                                    <span class="fw-bold">{{ $message->order->name }}</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-lg-row gap-lg-3">
                                <div class="d-flex gap-1">
                                    <span>{{ __('names.messageType') }}:</span>
                                    <span class="fw-bold">{{ $message->type->name }}</span>
                                </div>
                                <div class="d-flex gap-1">
                                    <span>{{ __('table.created_at') }}:</span>
                                    <span class="fw-bold">{{ $message->created_at ? $message->created_at->format('Y, F j, H:i') : '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-md-2">
                        <p>{!! $message->description !!}</p>
                        <div class="d-flex align-items-start justify-content-center">
                            <a href="{{ route('reply', [$prefix, $message->id]) }}" class="mark-as-read-button">
                                <i class="fa-solid fa-reply fs-5 me-3"></i>
                            </a>
                            @foreach ($message->messageUsers as $messageUser)
                                @if ($message->sender_id != auth()->user()->id && $messageUser->user_id == auth()->user()->id && !$messageUser->marked_as_read)
                                    {!! Form::open(['route' => ['markAsReadMessage', [$prefix, $message->id]], 'method' => 'post']) !!}
                                        <button type="submit" class="mark-as-read-button pt-0 pe-0" title="{{ __('buttons.markAsRead') }}">
                                            <i class="fa-solid fa-check fs-4"></i>
                                        </button>
                                    {!! Form::close() !!}
                                @endif
                            @endforeach
                            @if ($message->sender_id == auth()->user()->id)
                                <a href="{{ route('messages.edit', [$prefix, $message->id]) }}" class="mark-as-read-button">
                                    <i class="fa-solid fa-pen-to-square fs-5"></i>
                                </a>
                                {!! Form::open(['route' => ['messages.destroy', [$prefix, $message->id]], 'method' => 'delete']) !!}
                                    <button type="submit" class="btn mark-as-read-button pt-0" title="{{ __('buttons.deleteMessage') }}"
                                            onclick="return confirm('{{ __('names.areYouSureDeleteMessage') }}')">
                                        <i class="fa-solid fa-trash-can fs-5"></i>
                                    </button>
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col bg-white p-4 mt-4 border-around"">
                    <h5 class="mb-3">{{ __('names.replies') }}</h5>
                    @if (count($message->replyMessages) > 0)
                        @include('user_views.messages.tables.reply_messages_table')
                    @else
                        <span class="text-muted">{{ __('names.noReplies') }}</span>
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
            color: #0E84E1;
        }
    </style>
@endpush
