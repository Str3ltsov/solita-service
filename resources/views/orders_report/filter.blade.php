<div class="row">
    <div class="form-group col-lg-3 col-md-6 col-12">
        <label for="id">{{__('reports.orderId')}}:</label>
        <input type="number" name="id" class="form-control" value="{{ $filter['id'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-3 col-md-6 col-12">
        <label for="user.name">{{__('reports.user')}}:</label>
        <input type="text" name="user.name" class="form-control" value="{{ $filter['user.name'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-3 col-md-6 col-12">
        <label for="employee.name">{{__('table.employee')}}:</label>
        <input type="text" name="employee.name" class="form-control" value="{{ $filter['employee.name'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-3 col-md-6 col-12">
        <label for="status.id">{{__('reports.status')}}:</label>
        {!! Form::select('status.id', $statuses, $filter['status.id'] ?? '', ['class' => 'form-control', 'placeholder' => '']) !!}
    </div>
    <div class="form-group col-lg-6 col-12">
        <label for="name">{{__('table.name')}}:</label>
        <input type="text" name="name" class="form-control" value="{{ $filter['name'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-2 col-md-4 col-12">
        <label for="budget">{{__('table.budget')}}:</label>
        <input type="text" name="budget" class="form-control" value="{{ $filter['budget'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-2 col-md-4 col-12">
        <label for="total_hours">{{__('table.totalHours')}}:</label>
        <input type="text" name="total_hours" class="form-control" value="{{ $filter['total_hours'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-2 col-md-4 col-12">
        <label for="complete_hours">{{__('table.completeHours')}}:</label>
        <input type="text" name="complete_hours" class="form-control" value="{{ $filter['complete_hours'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-3 col-md-6 col-12">
        <label for="start_date">{{__('table.startDate')}}:</label>
        <input type="date" name="start_date" class="form-control" value="{{ $filter['start_date'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-3 col-md-6 col-12">
        <label for="end_date">{{__('table.endDate')}}:</label>
        <input type="date" name="end_date" class="form-control" value="{{ $filter['end_date'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-3 col-md-6 col-12">
        <label for="date_from">{{__('reports.dateFrom')}}:</label>
        <input type="datetime-local" name="date_from" class="form-control" value="{{ $filter['date_from'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-3 col-md-6 col-12">
        <label for="date_to">{{__('reports.dateTo')}}:</label>
        <input type="datetime-local" name="date_to" class="form-control" value="{{ $filter['date_to'] ?? '' }}"/>
    </div>
</div>
<div class="d-flex align-items-center justify-content-center mt-4">
    <div class="d-flex flex-column flex-md-row align-items-center gap-3 col-md-6 col-12">
        <button type="button" class="category-return-button py-2 px-4 col-md-6 col-12" onclick="filter()">
            {{ __('reports.filter') }}
        </button>
        <button type="reset" class="orders-returns-secondary-button py-2 col-md-6 col-12" onclick="document.location='{{ route('orders_report.index') }}'">
            {{ __('reports.clear') }}
        </button>
    </div>
</div>

@push('scripts')
    <script>
        const elements = document.querySelectorAll(".form-control");
        const index = '{{ route('orders_report.index') }}';

        for (let i = 0; i < elements.length; i++) {
            elements[i].addEventListener("keyup", function(e) {
                if (e.keyCode === 13) {
                    filter();
                }
            });
        }

        function filter() {
            let filters = [];

            for (let i = 0; i < elements.length; i++) {
                elements[i].value != '' ? filters.push(`filter[${elements[i].name}]=${elements[i].value}`) : '';
            }

            filters = `?${filters.join('&')}`;
            document.location.href = `${index}${filters}`;
        }

        function getReport(route) {
            const filters = document.location.search;

            document.location.href = `${index}${route}${filters}`;
        }
    </script>
@endpush
