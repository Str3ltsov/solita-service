@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.profile') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
    </div>
    <div class="container">
        <div class="mb-4 mt-5 d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
            <div class="mb-3 mb-md-0">
                <h3 class="mb-0">{{__('menu.profile')}}</h3>
                <div class="d-flex flex-column flex-md-row gap-md-4 gap-1 mt-1">
                    <div class="d-flex gap-2">
                        <span class="text-muted">{{ __('table.created_at') }}:</span>
                        <span>{{ $user->created_at ? $user->created_at->format('Y-m-d') : '-' }}</span>
                    </div>
                    <div class="d-flex gap-2">
                        <span class="text-muted">{{ __('table.updated_at') }}:</span>
                        <span>{{ $user->updated_at ? $user->updated_at->format('Y-m-d') : '-' }}</span>
                    </div>
                </div>
            </div>
            {!! Form::model($user, ['route' => ['deleteAccount', $prefix], 'method' => 'patch']) !!}
                <button type="submit" class="category-return-button px-4 w-100" data-loading-text="Loading..."
                        title="{{ __('names.accountDeletion') }}"
                        onclick="return confirm('{{ __('messages.areYouSureAccountDeletion') }}')">
                    <i class="fa-solid fa-trash-can me-2 fs-6"></i>
                    {{ __('names.accountDeletion') }}
                </button>
            {!! Form::close() !!}
        </div>
        <div class="col bg-white py-3 px-4 border-around">
            <div id="description" class="tabs tabs-simple tabs-simple-full-width-line tabs-product tabs-dark mb-2">
                <ul class="nav nav-tabs justify-content-start mb-0" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active py-2 px-3" href="#profile" data-bs-toggle="tab" aria-selected="true"
                           role="tab">
                            {{ __('menu.userInfo') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link-reviews py-2 px-3" href="#password" data-bs-toggle="tab"
                           aria-selected="false" tabindex="-1" role="tab">
                            {{ __('auth.passwordEnter') }}
                        </a>
                    </li>
                    @if (Auth::user()->type == 2)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link nav-link-reviews py-2 px-3" href="#skills" data-bs-toggle="tab"
                               aria-selected="false" tabindex="-2" role="tab" id="skillsTab">
                                {{ __('names.skills') }}
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content p-0">
                    <div class="tab-pane px-0 active" id="profile" role="tabpanel">
                        <div class="auth-form">
                            @include('user_views.user.profile_information')
                        </div>
                    </div>
                    <div class="tab-pane px-0" id="password" role="tabpanel">
                        <div class="auth-form">
                            @include('user_views.user.change_password')
                        </div>
                    </div>
                    @if (Auth::user()->type == 2)
                        <div class="tab-pane px-0" id="skills" role="tabpanel">
                            <div class="auth-form">
                                @if (count($skills) > 0)
                                    @include('user_views.user.add_skills')
                                @else
                                    <p class="mt-4 mb-4 text-muted text-center">{{ __('names.noAvailableSkills') }}</p>
                                @endif
                                <hr style="background: #bbb; height: 3.5px">
                                <div class="table table-responsive">
                                    @include('user_views.user.skills_table')
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
