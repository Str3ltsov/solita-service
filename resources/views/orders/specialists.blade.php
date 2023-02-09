@forelse($specialists as $specialist)
    <div class="pe-4 py-4 ps-4 ps-lg-2 d-flex flex-column flex-lg-row" style="box-shadow: 1px 1px 5px #d9d9d9">
        <div class="d-flex align-items-center justify-content-center col-12 col-lg-1 mb-4 mb-lg-0">
            <input type="checkbox" class="form-check-input me-2 specialist-checkbox" onclick="setSpecialistsIds()"
                   style="width: 30px; height: 30px" value="{{ $specialist->id }}">
        </div>
        <div class="d-flex flex-column gap-1 col-12 col-lg-11">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column gap-1">
                    <h5 class="mb-0">{{ $specialist->name }}</h5>
                    <div class="d-flex flex-column flex-lg-row gap-0 gap-lg-3">
                        <span>
                            {{ __('forms.hourly_price') }}:
                            <b style="letter-spacing: -3px">€</b>
                            <b id="specHourlyPrice">{{ number_format($specialist->hourly_price, 2) }}</b>
                        </span>
                        <span>
                            {{ __('table.workExperience') }}:
                            <b>{{ $specialist->experience->name.' '.__('table.year') }}</b>
                        </span>
                        <span>
                            {{ __('table.occupationPercentage') }}:
                            <b>{{ $specialist->occupation->percentage.'%' ?? '-' }}</b>
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-center fs-5 fw-bold">
                    <span>{{ $specialistAverageRating[$loop->index] }}</span>
                    <span>/</span>
                    <span>5</span>
                    @if ($specialistAverageRating[$loop->index] > 0)
                        <i class="fa-solid fa-star text-warning ms-1"></i>
                    @else
                        <i class="fa-regular fa-star text-warning ms-1"></i>
                    @endif
                </div>
            </div>
            <div style="background: #ececec; height: 1px; width: 100%; margin: 10px 0"></div>
            <p class="mx-0 my-1 p-0">{{ $specialist->work_info ?? '-' }}</p>
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
            <div style="background: #ececec; height: 1px; width: 100%; margin: 15px 0"></div>
            <div class="d-flex flex-column flex-lg-row gap-2 mt-lg-1 specialist-hours-wrapper">
                <div class="form-group col-lg-4 col-md-5 col-6 mb-2 d-flex align-items-center gap-2">
                    {!! Form::label('hours', __('table.totalHours').':') !!}
                    {!! Form::number('hours', 0, [
                        'class' => 'form-control specialist-number',
                        'style' => 'width: 70px',
                        'min' => 0,
                        'oninput' => "setSpecialistHours(); calculateSum(); this.value =
                            !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                    ]) !!}
                </div>
            </div>
        </div>
    </div>
@empty
    <span class="text-muted">{{ __('names.noSpecialists') }}</span>
@endforelse
