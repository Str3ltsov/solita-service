<div class="card-body">
    <div class="row">
        <div class="form-group col-sm-2">
            <label for="id">{{__('reports.activityId')}}:</label>
            <input type="number" name="id" class="form-control"/>
        </div>
        <div class="form-group col-sm-4">
            <label for="user.name">{{__('forms.name')}}:</label>
            <input type="text" name="user.name" class="form-control"/>
        </div>
        <div class="form-group col-sm-4">
            <label for="user.email">Email:</label>
            <input type="text" name="user.email" class="form-control"/>
        </div>
        <div class="form-group col-sm-2">
            <label for="user.type">{{__('table.userType')}}:</label>
            <select name="user.type" class="form-control">
                <option></option>
                <option value="1">{{__('reports.admin')}}</option>
                <option value="2">{{__('reports.user')}}</option>
            </select>
        </div>
        <div class="form-group col-sm-6">
            <label for="activity">{{__('reports.activity')}}:</label>
            <input type="text" name="activity" class="form-control"/>
        </div>
        <div class="form-group col-sm-3">
            <label for="date_from">{{__('reports.dateFrom')}}:</label>
            <input type="datetime-local" name="date_from" class="form-control"/>
        </div>
        <div class="form-group col-sm-3">
            <label for="date_to">{{__('reports.dateTo')}}:</label>
            <input type="datetime-local" name="date_to" class="form-control"/>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-primary" onclick="filter()">{{__('reports.filter')}}</button>
    <button type="reset" class="btn btn-secondary" onclick="document.location='{{ route('user_activities_report.index') }}'">
        {{__('reports.clear')}}
    </button>
    <div class="float-end">
        <button type="button" class="btn btn-secondary" onclick="getReport('/download_pdf')">
            {{__('reports.download')}} PDF
        </button>
        <button type="button" class="btn btn-secondary" onclick="getReport('/download_csv')">
            {{__('reports.download')}} CSV
        </button>
        <button type="button" class="btn btn-secondary" onclick="getReport('/email')">
            {{__('reports.sendEmail')}}
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
