<div class="row">
    <div class="form-group col-lg-2 col-md-6 col-12">
        <label for="id">{{__('table.id')}}:</label>
        <input type="number" name="id" class="form-control" value="{{ $filter['id'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-4 col-md-6 col-12">
        <label for="name">{{__('table.name')}}:</label>
        <input type="text" name="user.name" class="form-control" value="{{ $filter['name'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-4 col-md-6 col-12">
        <label for="email">{{__('table.email')}}:</label>
        <input type="text" name="email" class="form-control" value="{{ $filter['email'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-2 col-md-6 col-12">
        <label for="phone_number">{{__('forms.phone_number')}}:</label>
        <input type="text" name="phone_number" class="form-control" value="{{ $filter['phone_number'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-4 col-md-6 col-12">
        <label for="street">{{__('forms.street')}}:</label>
        <input type="text" name="street" class="form-control" value="{{ $filter['street'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-2 col-md-6 col-12">
        <label for="house_flat">{{__('forms.house_flat')}}:</label>
        <input type="text" name="house_flat" class="form-control" value="{{ $filter['house_flat'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-2 col-md-6 col-12">
        <label for="post_index">{{__('forms.post_index')}}:</label>
        <input type="text" name="post_index" class="form-control" value="{{ $filter['post_index'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-4 col-md-6 col-12">
        <label for="city">{{__('forms.city')}}:</label>
        <input type="text" name="city" class="form-control" value="{{ $filter['city'] ?? '' }}"/>
    </div>
    <div class="form-group col-lg-3 col-md-6 col-12">
        <label for="role.id">{{__('table.userType')}}:</label>
        {!! Form::select('role.id', $roles, $filter['role.id'] ?? '', ['class' => 'form-control', 'placeholder' => '']) !!}
    </div>
    <div class="form-group col-lg-3 col-md-6 col-12">
        <label for="status.id">{{__('table.status')}}:</label>
        {!! Form::select('status.id', $statuses, $filter['status.id'] ?? '', ['class' => 'form-control', 'placeholder' => '']) !!}
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
        <button type="reset" class="orders-returns-secondary-button py-2 col-md-6 col-12" onclick="document.location='{{ route('users_report.index') }}'">
            {{ __('reports.clear') }}
        </button>
    </div>
</div>

@push('scripts')
    <script>
        const elements = document.querySelectorAll(".form-control");
        const index = '{{ route('users_report.index') }}';

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
