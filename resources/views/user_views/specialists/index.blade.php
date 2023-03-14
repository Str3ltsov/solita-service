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
                    <div class="col-lg-9 col-12 order-1 order-lg-0">
                        <div class="row d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 mb-4">
                            <div class="col-lg-7">
                                <h2 class="mb-0">
                                    {{ __('names.specialists') }}
                                </h2>
                                <div class="text-muted mb-2 mb-lg-0">
                                    {{ __('names.showing') }}
                                    {{ count($specialists) }}
                                    {{ __('names.of') }}
                                    {{ count($specialists).' '.__('names.entries') }}
                                </div>
                            </div>
                            <div class="col-lg-5">
                                {!! Form::select('order', $orderList, $selectedOrder,
                                    ['class' => 'form-select w-100', 'id' => 'orderSelector', 'style' => 'cursor: pointer']) !!}
                            </div>
                        </div>
                        <div class="col-12">
                            @include('user_views.specialists.specialist_list')
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 order-0 order-lg-1">
                        @include('user_views.specialists.filters')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('orderSelector').onchange = () => {
            addOrderValueToFilter();
            document.getElementById('mainForm').submit();
        }

        const addOrderValueToFilter = () => document.getElementById('order').value = $('#orderSelector').val();

        const setSkills = () => {
            const skills = document.querySelectorAll("#skill");

            let value = '';

            skills.forEach(skill => {
                value += skill.checked && value ? ',' : '';
                value += skill.checked ? skill.value : "";
            })

            console.log(value);

            const skillsInput = document.getElementById("filter[skills_users.skill_id]");
            skillsInput.value = value;
        }

        $(() => {
            const rangeSlider = document.getElementById('range-slider');
            const ratingFrom = document.getElementById('filter[rating_from]');
            const ratingTo = document.getElementById('filter[rating_to]');

            $(rangeSlider).slider({
                range: true,
                min: 0,
                max: {{ $maxRating }},
                values: [{{ $filter["rating_from"] ?? 0 }}, {{ $filter["rating_to"] ?? $maxRating }}],
                slide: (event, ui) => {
                    $(ratingFrom).val(ui.values[0]);
                    $(ratingTo).val(ui.values[1]);
                }
            });
            $(ratingFrom).val($(rangeSlider).slider("values", 0));
            $(ratingTo).val($(rangeSlider).slider("values", 1));
        });
    </script>
@endpush
