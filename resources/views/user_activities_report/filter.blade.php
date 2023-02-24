<div class="row">
    <div class="form-group col-lg-2 col-md-6 col-12">
        <label for="id">{{__('reports.activityId')}}:</label>
        <input type="number" name="id" class="form-control" value="{{ $filter['id'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-4 col-md-6 col-12">
        <label for="user.name">{{__('forms.name')}}:</label>
        <input type="text" name="user.name" class="form-control" value="{{ $filter['user.name'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-4 col-md-6 col-12">
        <label for="user.email">{{ __('table.email') }}:</label>
        <input type="text" name="user.email" class="form-control" value="{{ $filter['user.email'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-2 col-md-6 col-12">
        <label for="user.type">{{__('table.userType')}}:</label>
        {!! Form::select('user.type', $roles, $filter['user.type'] ?? '', ['class' => 'form-control', 'placeholder' => '']) !!}
    </div>
    <div class="form-group col-sm-6">
        <label for="activity">{{__('reports.activity')}}:</label>
        <input type="text" name="activity" class="form-control" value="{{ $filter['activity'] ?? '' }}"/>
    </div>
    <div class="form-group col-sm-3">
        <label for="date_from">{{__('reports.dateFrom')}}:</label>
        <input type="datetime-local" name="date_from" class="form-control" value="{{ $filter['date_from'] ?? '' }}"/>
    </div>
    <div class="form-group col-sm-3">
        <label for="date_to">{{__('reports.dateTo')}}:</label>
        <input type="datetime-local" name="date_to" class="form-control" value="{{ $filter['date_to'] ?? '' }}"/>
    </div>
</div>
<div class="d-flex align-items-center justify-content-center mt-4">
    <div class="d-flex flex-column flex-md-row align-items-center gap-3 col-md-6 col-12">
        <button type="button" class="category-return-button py-2 px-4 col-md-6 col-12" onclick="filter()">
            {{ __('reports.filter') }}
        </button>
        <button type="reset" class="orders-returns-secondary-button py-2 col-md-6 col-12" onclick="document.location='{{ route('user_activities_report.index') }}'">
            {{ __('reports.clear') }}
        </button>
    </div>
</div>

@push('scripts')
    <script>
        const elements = document.querySelectorAll(".form-control");
        const index = '{{ route('user_activities_report.index') }}';

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
