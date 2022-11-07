<div class="card-body">
    <div class="row">
        <div class="form-group col-sm-1">
            <label for="id">{{__('reports.cartId')}}:</label>
            <input type="number" name="id" class="form-control"/>
        </div>
        <div class="form-group col-sm-2">
            <label for="user.name">{{__('reports.user')}}:</label>
            <input type="text" name="user.name" class="form-control"/>
        </div>
        <div class="form-group col-sm-4">
            <label for="code">{{__('reports.code')}}:</label>
            <input type="text" name="code" class="form-control"/>
        </div>
        <div class="form-group col-sm-1">
            <label for="status.name">{{__('reports.status')}}:</label>
            <select name="status.name" class="form-control">
                <option></option>
                <option value="On">On</option>
                <option value="Off">Off</option>
            </select>
        </div>
        <div class="form-group col-sm-2">
            <label for="date_from">{{__('reports.dateFrom')}}:</label>
            <input type="datetime-local" name="date_from" class="form-control"/>
        </div>
        <div class="form-group col-sm-2">
            <label for="date_to">{{__('reports.dateTo')}}:</label>
            <input type="datetime-local" name="date_to" class="form-control"/>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-primary" onclick="filter()">{{__('reports.filter')}}</button>
    <button type="reset" class="btn btn-secondary" onclick="document.location='{{ route('carts_report.index') }}'">
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
        const index = '{{ route('carts_report.index') }}';

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
