<table class="table table-striped my-3" id="categories">
    <thead style="background: #e7e7e7;">
    <tr>
{{--        <th class="text-center px-3">#</th>--}}
        <th class="px-3">{{ __('table.id') }}</th>
        <th class="px-3">{{ __('table.name') }}</th>
        <th class="px-3">{{ __('table.parentId') }}</th>
        <th class="px-3">{{ __('table.visible') }}</th>
        <th class="px-3">{{ __('table.created_at') }}</th>
        <th class="px-3">{{ __('table.updated_at') }}</th>
        <th class="px-3"></th>
    </tr>
    </thead>
    <tbody>
    @forelse ($categories as $category)
        <tr>
{{--            <td class="text-center px-3">{{ $loop->index + 1 }}</td>--}}
            <td class="px-3">{{ $category->id }}</td>
            <td class="px-3">{{ $category->name }}</td>
            <td class="px-3">{{ $category->parent_id ?? '-' }}</td>
            <td class="px-3">{{ $category->visible ? __('names.yes') : __('names.no') }}</td>
            <td class="px-3">{{ $category->created_at }}</td>
            <td class="px-3">{{ $category->updated_at }}</td>
            <td class="px-3">
                <div class='btn-group w-100 d-flex justify-content-between align-items-center'>
                    <a href="{{ route('categories.show', [$category->id]) }}"
                       class='btn btn-primary orders-returns-clear-button px-0'>
                        <i class="far fa-eye fs-5 mx-2"></i>
                    </a>
                    <a href="{{ route('categories.edit', [$category->id]) }}"
                       class='btn btn-primary orders-returns-clear-button px-0'>
                        <i class="fa-solid fa-pen-to-square fs-5 mx-2"></i>
                    </a>
                    {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
                    <button type="submit" class='btn btn-primary orders-returns-clear-button px-0'
                            onclick="return confirm('{{ __('names.areYouSureDeleteCategory') }}')">
                        <i class="fa-solid fa-trash-can fs-5 mx-2"></i>
                    </button>
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-muted text-center">{{ __('names.noCategories') }}</td>
        </tr>
    @endforelse
    </tbody>
</table>

