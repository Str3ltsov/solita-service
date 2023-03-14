@forelse($specialists as $specialist)
    <div class="bg-white p-4 product-section border-around">
        <div class="d-flex flex-column gap-1">
            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                <div class="d-flex flex-column gap-1">
                    <h5 class="mb-2 mb-md-0">{{ $specialist->name }}</h5>
                    <div class="d-flex flex-column flex-sm-row gap-sm-3">
{{--                        <span>--}}
{{--                            {{ __('forms.hourly_price') }}:--}}
{{--                            <b>€{{ number_format($specialist->hourly_price, 2) }}</b>--}}
{{--                        </span>--}}
                        <span>
                            {{ __('table.workExperience') }}:
                            <b>{{ $specialist->experience ? $specialist->experience->name.' '.__('table.year') : '-' }}</b>
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-center fs-5 fw-bold mt-3 mt-md-0">
                    <span>{{ $specialist->average_rating }}</span>
                    <span>/</span>
                    <span>5</span>
                    @if ($specialist->average_rating > 0)
                        <i class="fa-solid fa-star text-warning ms-1"></i>
                    @else
                        <i class="fa-regular fa-star text-warning ms-1"></i>
                    @endif
                    <a href="{{ route('userReviews', [$specialist->id]) }}" class="orders-returns-primary-button px-4 py-2 ms-2">
                        <i class="fa-solid fa-star me-1"></i>
                        {{ __('names.reviews') }}
                    </a>
                </div>
            </div>
            <div style="background: #ececec; height: 1px; width: 100%; margin: 10px 0"></div>
            <p class="mx-0 my-1 p-0 @if (is_null($specialist->work_info)) text-muted @endif">
                {{ $specialist->work_info ?? __('names.noWorkInfo') }}
            </p>
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
