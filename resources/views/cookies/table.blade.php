{{--<div class="table-responsive">--}}
{{--    <table class="table" id="returns-table">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>ID</th>--}}
{{--            <th>{{__('table.name')}}</th>--}}
{{--            <th>{{__('table.description')}}</th>--}}
{{--            <th>{{__('table.mandatoryStatus')}}</th>--}}
{{--            <th colspan="3">{{__('table.action')}}</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($cookies as $cookie)--}}
{{--            <tr>--}}
{{--                <td>{{ $cookie->id }}</td>--}}
{{--                <td>{{ $cookie->name }}</td>--}}
{{--                <td>{{ $cookie->description }}</td>--}}
{{--                <td>{{ $cookie->isMandatory}}</td>--}}
{{--                <td width="120">--}}
{{--                    {!! Form::open(['route' => ['cookies.destroy', $cookie->id], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                        <a href="{{ route('cookies.show', [$cookie->id]) }}"--}}
{{--                           class='btn btn-default btn-xs'>--}}
{{--                            <i class="far fa-eye"></i>--}}
{{--                        </a>--}}
{{--                        <a href="{{ route('cookies.edit', [$cookie->id]) }}"--}}
{{--                           class='btn btn-default btn-xs'>--}}
{{--                            <i class="far fa-edit"></i>--}}
{{--                        </a>--}}
{{--                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--</div>--}}

<table class="table table-striped table-bordered my-3" id="categories">
    <thead style="background: #e7e7e7;">
    <tr>
        {{--        <th class="text-center px-3">#</th>--}}
        <th class="px-3">{{ __('table.id') }}</th>
        <th class="px-3">{{ __('table.name') }}</th>
        <th class="px-3">{{ __('table.description') }}</th>
        <th class="px-3">{{ __('table.mandatoryStatus') }}</th>
        <th class="px-3">{{ __('table.created_at') }}</th>
        <th class="px-3">{{ __('table.updated_at') }}</th>
        <th class="px-3"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($cookies as $cookie)
        <tr>
            {{--            <td class="text-center px-3">{{ $loop->index + 1 }}</td>--}}
            <td class="px-3">{{ $cookie->id }}</td>
            <td class="px-3">{{ $cookie->name }}</td>
            <td class="px-3">{{ $cookie->description }}</td>
            <td class="px-3">{{ $cookie->isMandatory }}</td>
            <td class="px-3">{{ $cookie->created_at ?? '-' }}</td>
            <td class="px-3">{{ $cookie->updated_at ?? '-' }}</td>
            <td class="px-3">
                <div class='btn-group w-100 d-flex justify-content-between align-items-center'>
                    <a href="{{ route('cookies.show', [$cookie->id]) }}"
                       class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'>
                        <i class="far fa-eye fs-5 mx-2"></i>
                    </a>
                    <a href="{{ route('cookies.edit', [$cookie->id]) }}"
                       class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'>
                        <i class="fa-solid fa-pen-to-square fs-5 mx-2"></i>
                    </a>
                    {!! Form::open(['route' => ['cookies.destroy', $cookie->id], 'method' => 'delete']) !!}
                    <button type="submit" class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'
                            onclick="return confirm('{{ __('names.areYouSureDeleteQuestion') }}')">
                        <i class="fa-solid fa-trash-can fs-5 mx-2"></i>
                    </button>
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

