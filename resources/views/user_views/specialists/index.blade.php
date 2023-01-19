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
                        <h2 class="mb-0" style="font-family: 'Times New Roman', sans-serif">
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
                    @forelse($specialists as $specialist)
                        <div class="bg-white p-4 product-section">
                            <div class="d-flex flex-column gap-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column gap-1">
                                        <h5 class="mb-0">{{ $specialist->name }}</h5>
                                        <div class="d-flex flex-column flex-sm-row gap-3">
                                            <span>
                                                {{ __('forms.hourly_price') }}:
                                                <b>€{{ number_format($specialist->hourly_price, 2) }}</b>
                                            </span>
                                                                <span>
                                                {{ __('table.workExperience') }}:
                                                <b>{{ $specialist->experience->name.' '.__('table.year') }}</b>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center fs-5 fw-bold">
                                        <span>{{ $specialist->averageRating }}</span>
                                        <span>/</span>
                                        <span>5</span>
                                        @if ($specialist->averageRating > 0)
                                            <i class="fa-solid fa-star text-warning ms-1"></i>
                                        @else
                                            <i class="fa-regular fa-star text-warning ms-1"></i>
                                        @endif
                                        <a href="{{ route('userReviews', [$specialist->id]) }}" class="orders-returns-primary-button px-4 py-2 ms-2">
                                            {{ __('names.reviews') }}
                                        </a>
                                    </div>
                                </div>
                                <div style="background: #ececec; height: 1px; width: 100%; margin: 10px 0"></div>
                                <p class="mx-0 my-1 p-0">{{ $specialist->work_info }}</p>
                                <div style="background: #ececec; height: 1px; width: 100%; margin: 10px 0"></div>
                                <div class="d-flex flex-column flex-md-row gap-2 mt-md-1">
                                    <span class="fw-bold fs-6">{{ __('names.skills') }}:</span>
                                    <div class="d-flex gap-2 flex-wrap">
                                        @forelse($specialist->skillsUsers as $specialistSkill)
                                            <div class="py-1 px-3 d-flex gap-1" style="background: #eaeaea">
                                                <span>{{ $specialistSkill->skill->name }}</span>
                                                <span>
                                                    ({{ $specialistSkill->experience ?? '0' }}
                                                    @if ($specialistSkill->experience > 1) {{ __('names.years').')' }} @else {{ __('names.year').')' }} @endif
                                                </span>
                                            </div>
                                        @empty
                                            <span class="text-muted">{{ __('names.noSkills') }}</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <span class="text-muted">{{ __('names.noSpecialists') }}</span>
                    @endforelse
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
