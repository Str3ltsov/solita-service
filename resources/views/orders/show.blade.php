@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url("/admin/orders") }}">
                {{ __('menu.orders') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $order->id ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="row mb-4">
                    <h3 class="mt-3">
                        {{ __('names.order') }}: {{ $order->id }}
                    </h3>
                </div>
                <div class="row bg-white mx-md-0 p-3 mb-4 border-around">
                    <h5 class="mt-2 mb-3">{{ __('names.order') }}</h5>
                    <div class="d-flex flex-column flex-lg-row justify-content-between">
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.title') }}:</span>
                                <span class="text-black">{{ $order->name }}</span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                {{__('names.customer')}}:
                                <a href="{{ route('userReviews', [$order->user_id]) }}" class="fw-bold d-flex gap-1">
                                    {{ __($order->user->name) }}
                                    <div class="d-flex align-items-center">
                                        <span>{{ round(number_format($order->user->average_rating, 2), 1) ?? 0 }}</span>
                                        <span>/</span>
                                        <span>5</span>
                                        @if ($order->user->average_rating > 0)
                                            <i class="fa-solid fa-star text-warning ms-1"></i>
                                        @else
                                            <i class="fa-regular fa-star text-warning ms-1"></i>
                                        @endif
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                {{__('table.employee')}}:
                                <a href="{{ route('userReviews', [$order->employee_id]) }}"
                                   class="fw-bold d-flex gap-1">
                                    {{ __($order->employee->name) }}
                                    <div class="d-flex align-items-center">
                                        <span>{{ round(number_format($order->employee->average_rating, 2), 1) ?? 0 }}</span>
                                        <span>/</span>
                                        <span>5</span>
                                        @if ($order->employee->average_rating > 0)
                                            <i class="fa-solid fa-star text-warning ms-1"></i>
                                        @else
                                            <i class="fa-regular fa-star text-warning ms-1"></i>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.status') }}:</span>
                                <span class="text-black">
                                    @foreach(\App\Models\Order::getOrderStatuses() as $key => $orderStatus)
                                        @if ($order->status->id === $key)
                                            {{ $orderStatus[$key] }}
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.budget') }}:</span>
                                <span class="text-black">€{{ number_format(($order->budget * $order->total_hours), 2) }}</span>
                            </div>
                            @if ($order->status_id >= 3)
                                <div class="d-flex gap-2 text-muted">
                                    <span>{{ __('buttons.advancePayment') }}:</span>
                                    <span class="text-black">
                                        @if ($order->advance_payment)
                                            {{ __('names.complete') }}
                                        @else
                                            {{ __('names.awaiting') }}
                                        @endif
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.totalHours') }}:</span>
                                <span class="text-black">{{ $order->total_hours.' '.__('table.hour') }}</span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.completeHours') }}:</span>
                                <span class="text-black">
                                    {{ $order->complete_hours ? $order->complete_hours.' '.__('table.hour') : '-' }}
                                </span>
                            </div>
                            @if ($order->status_id >= 7)
                                <div class="d-flex gap-2 text-muted">
                                    <span>{{ __('buttons.finalPayment') }}:</span>
                                    <span class="text-black">
                                        @if ($order->complete_payment)
                                            {{ __('names.complete') }}
                                        @else
                                            {{ __('names.awaiting') }}
                                        @endif
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.startDate') }}:</span>
                                <span
                                        class="text-black">{{ $order->start_date ? $order->start_date->format('Y-m-d') : '-' }}</span>
                            </div>
                            <div class="d-flex gap-2 text-muted">
                                <span>{{ __('table.endDate') }}:</span>
                                <span
                                        class="text-black">{{ $order->end_date ? $order->end_date->format('Y-m-d') : '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-4">
                    <div class="d-flex flex-column flex-md-row gap-md-2 gap-0 text-muted my-2">
                        <span>{{ __('table.description') }}:</span>
                        <span class="text-black">{{ $order->description ?? '-' }}</span>
                    </div>
                    <hr class="mt-4">
                    <div class="d-flex flex-column flex-lg-row gap-0 text-muted my-2">
                        <div class="d-flex flex-column col-lg-6 col-12">
                            @forelse($order->questionAnswers as $questionAnswer)
                                @if ($loop->index < 3)
                                    @if ($loop->first)
                                        <div class="d-flex gap-2 text-muted">
                                            <span>{{ $questionAnswer->question->question }}:</span>
                                            <div class="text-black d-flex">
                                                <span>{{ number_format($questionAnswer->answer, 1) }}</span>
                                                <span>/</span>
                                                <span>5</span>
                                            </div>
                                            <span>
                                                <i class="fa-solid fa-star text-warning"></i>
                                            </span>
                                        </div>
                                    @else
                                        <div class="d-flex gap-2 text-muted">
                                            <span>{{ $questionAnswer->question->question }}:</span>
                                            <span class="text-black">{{ $questionAnswer->answer }}</span>
                                        </div>
                                    @endif
                                @else
                                    @break
                                @endif
                            @empty
                                <span class="text-muted">{{ __('names.noOrderReview') }}</span>
                            @endforelse
                        </div>
                        <div class="d-flex flex-column col-lg-6 col-12">
                            @foreach($order->questionAnswers as $questionAnswer)
                                @if ($loop->index > 2)
                                    <div class="d-flex gap-2 text-muted">
                                        <span>{{ $questionAnswer->question->question }}:</span>
                                        <span class="text-black">{{ $questionAnswer->answer }}</span>
                                    </div>
                                @else
                                    @continue
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row bg-white mx-0 p-3 mb-4 border-around">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <h5 class="my-2">{{ __('names.specialists') }}</h5>
                        <div class="d-flex gap-2">
                            @if ($specialistCount > 0)
                                <a href="{{ route('adminAddOrderSpecialist', $order->id) }}"
                                   class="category-return-button px-4">
                                    <i class="fa-solid fa-plus me-1"></i>
                                    {{ __('buttons.addNew') }}
                                </a>
                            @endif
                            {!! Form::model($order, ['route' => ['adminUpdateOrderSpecialists', $order->id], 'method' => 'post']) !!}
                            <input type="text" name="specHours" id="specHours" class="d-none">
                            <button type="submit" class="category-return-button px-4" id="submitUpdateSpecHours">
                                {{ __('buttons.save') }}
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="table table-responsive">
                        @include('orders.tables.order_specialists_table')
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3 pb-4 mb-4 border-around">
                    <h5 class="my-2">{{ __('names.files') }}</h5>
                    <div class="col-md-6 col-12">
                        @include('user_views.orders.upload_document')
                    </div>
                    <div class="col-md-6 col-12 d-flex flex-column mt-4 mt-md-0">
                        <div class="p-3 overflow-scroll d-flex flex-column gap-2"
                             style="border: 1px solid lightgray; height: 170px">
                            @forelse($order->files as $orderFile)
                                <a href="{{ route('downloadDocument', [$prefix, $order->id, $orderFile->id]) }}"
                                   class="d-flex flex-wrap align-items-center py-2 px-3 shadow-sm">
                                    @if ($orderFileExtensions[$loop->index] === 'txt' || $orderFileExtensions[$loop->index] === 'text')
                                        <i class="fa-solid fa-file-lines fs-5 me-2"></i>
                                    @elseif ($orderFileExtensions[$loop->index] === 'pdf')
                                        <i class="fa-solid fa-file-pdf fs-5 me-2"></i>
                                    @else
                                        <i class="fa-solid fa-file-word fs-5 me-2"></i>
                                    @endif
                                    <span class="fw-bold">{{ $orderFile->name }}</span>
                                </a>
                            @empty
                                <span class="text-muted">{{ __('names.noFiles') }}</span>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="row bg-white mx-0 p-3 border-around">
                    <h5 class="my-2">{{ __('names.orderHistory') }}</h5>
                    @include('orders.log_table')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const specHoursInputs = document.querySelectorAll('#specHoursInput');
        const specHoursInputsSpans = document.querySelectorAll('#specHoursSpan');
        const submitUpdateSpecHours = document.getElementById('submitUpdateSpecHours');

        submitUpdateSpecHours.classList.add('d-none');

        specHoursInputs.forEach(specHoursInput => {
            specHoursInput.classList.toggle('d-none')
        });

        const setSpecHours = () => {
            let specHours = ''

            for (let i = 0; i < specHoursInputs.length; i++) {
                if (specHours)
                    specHours = specHours.concat(',')

                specHours = specHours.concat(specHoursInputs[i].value)
            }

            document.getElementById('specHours').value = specHours
        }

        const showEditSpecHours = (specHoursNum) => {
            specHoursInputs[specHoursNum].classList.toggle('d-none')
            specHoursInputsSpans[specHoursNum].classList.toggle('d-none')
            submitUpdateSpecHours.classList.remove('d-none')

            let specHoursInputsHidden = []
            let specHoursInputsHiddenTrue = [];

            specHoursInputs.forEach(specHoursInput => {
                if (specHoursInput.classList.contains('d-none'))
                    specHoursInputsHidden.push(true)
                else
                    specHoursInputsHidden.push(false)

                specHoursInputsHiddenTrue.push(true)
            })

            if (JSON.stringify(specHoursInputsHidden) === JSON.stringify(specHoursInputsHiddenTrue))
                submitUpdateSpecHours.classList.add('d-none')

            setSpecHours();
        }
    </script>
@endpush


