{!! Form::open(['route' => ['postCreateOrder', $prefix], 'method' => 'post', 'class' => 'auth-form-container row gap-4 gap-md-0']) !!}
    <div class="col-md-8 col-12 d-flex flex-column gap-4">
        <div class="row bg-white m-md-0 px-2 pt-4 pb-4">
            <h5 class="mb-4">{{ __('names.order') }}</h5>
            {{ Form::hidden('order_id', 0) }}
            {{ Form::hidden('user_id', auth()->user()->id) }}
            {{ Form::hidden('employee_id', $employeeId) }}
            {{ Form::hidden('status_id', 1) }}
            {{ Form::hidden('priority_id', 1) }}
            {{ Form::hidden('delivery_time', $product->delivery_time ?? null) }}
            <div class="form-group col-lg-6 col-12 mb-2">
                {!! Form::label('name', __('table.title') )!!}
                @if (isset($product))
                    {!! Form::text('name', $product->name, ['class' => 'form-control', 'readonly']) !!}
                @else
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                @endif
            </div>
            <div class="form-group col-lg-3 col-6 mb-2">
                {!! Form::label('budget', __('table.budget').' (€)') !!}
                {!! Form::number('budget', null, ['class' => 'form-control', 'oninput' => 'calculateSum(); this.value =
                    !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"']) !!}
            </div>
            <div class="form-group col-lg-3 col-6 mb-2">
                {!! Form::label('total_hours', __('table.totalHours')) !!}
                {!! Form::number('total_hours', null, ['class' => 'form-control', 'oninput' => 'this.value =
                    !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null']) !!}
            </div>
            <div class="form-group col-md-6 col-sm-12 mb-2">
                {!! Form::label('start_date', __('table.startDate')) !!}
                <input type="date" name="start_date" min="{{ now()->format('Y-m-d') }}" class="form-control">
            </div>
            <div class="form-group col-md-6 col-sm-12 mb-2">
                {!! Form::label('end_date', __('table.endDate')) !!}
                <input type="date" name="end_date" min="{{ now()->format('Y-m-d') }}" class="form-control">
            </div>
            <div class="form-group col-12 mb-2">
                {!! Form::label('description', __('forms.description')) !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
            </div>
        </div>
        <div class="row bg-white m-md-0 px-2 pt-4 pb-4">
            <h5 class="mb-4">{{ __('names.specialists') }}</h5>
            <div class="d-flex flex-column gap-4">
                @include('user_views.create_order.specialists')
                <input type="text" name="specialistsIds" id="specialistsIds" class="d-none">
                <input type="text" name="specialistsHours" id="specialistsHours" class="d-none">
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="row bg-white m-md-0 px-2 pt-4 pb-4" style="position: sticky; top: 100px; left: 0">
            <h5 class="mb-4">{{ __('names.overview') }}</h5>
            <div class="d-flex justify-content-between align-items-center fs-6">
                <span class="fw-bold">{{ __('names.total').':' }}</span>
                <span>
                    <b style="letter-spacing: -3px">€</b>
                    <span class="fw-bold" id="totalSum">0.00</span>
                </span>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="col-12 py-2 category-return-button" data-loading-text="Loading...">
                    {{ __('buttons.placeOrder') }}
                </button>
            </div>
        </div>
    </div>
{!! Form::close() !!}

@push('scripts')
    <script>
        const specialistNumberWrappers = document.querySelectorAll('.specialist-hours-wrapper');

        specialistNumberWrappers.forEach(specialistNumberWrapper => {
            specialistNumberWrapper.classList.add('d-none')
        });

        let specialistsCheckboxes = document.querySelectorAll('.specialist-checkbox');
        let specialistsNumbers = document.querySelectorAll('.specialist-number');

        const setSpecialistsIds = () => {
            let specialistsIds = ''

            for (let i = 0; i < specialistsCheckboxes.length; i++) {
                if (specialistsCheckboxes[i].checked && specialistsIds)
                    specialistsIds = specialistsIds.concat(',')

                if (specialistsCheckboxes[i].checked) {
                    specialistsIds = specialistsIds.concat(specialistsCheckboxes[i].value)
                    specialistNumberWrappers[i].classList.remove('d-none')
                }
                else
                    specialistNumberWrappers[i].classList.add('d-none')
            }

            document.getElementById('specialistsIds').value = specialistsIds
        }

        const setSpecialistHours = () => {
            let specialistsHours = ''

            for (let i = 0; i < specialistsNumbers.length; i++) {
                if (specialistsHours)
                    specialistsHours = specialistsHours.concat(',')

                specialistsHours = specialistsHours.concat(specialistsNumbers[i].value)
            }

            document.getElementById('specialistsHours').value = specialistsHours
        }

        const calculateSum = () => {
            const specialistHourlyPrices = document.querySelectorAll('#specHourlyPrice')

            let specialistHourlyPriceSum = 0

            for (let i = 0; i < specialistsNumbers.length; i++) {
                specialistHourlyPriceSum += specialistsNumbers[i].value * specialistHourlyPrices[i].innerHTML
            }

            const totalSum = document.getElementById('totalSum')
            const budget = document.querySelector("input[name='budget']").value

            totalSum.replaceChildren((parseFloat(budget) + specialistHourlyPriceSum).toFixed(2))
        }
    </script>
@endpush
