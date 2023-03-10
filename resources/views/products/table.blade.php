<table class="table table-striped my-3" id="categories">
    <thead style="background: #e7e7e7;">
    <tr>
        {{--        <th class="text-center px-3">#</th>--}}
        <th class="px-3">{{ __('table.id') }}</th>
        <th class="px-3">{{ __('table.name') }}</th>
        <th class="px-3">{{ __('table.price') }}</th>
        <th class="px-3">{{ __('table.image') }}</th>
        <th class="px-3">{{ __('table.categories') }}</th>
        <th class="px-3">{{ __('table.visible') }}</th>
        <th class="px-3">{{ __('table.created_at') }}</th>
        <th class="px-3">{{ __('table.updated_at') }}</th>
        <th class="px-3"></th>
    </tr>
    </thead>
    <tbody>
    @forelse ($products as $product)
        <tr>
            {{--            <td class="text-center px-3">{{ $loop->index + 1 }}</td>--}}
            <td class="px-3">{{ $product->id }}</td>
            <td class="px-3">{{ $product->name }}</td>
            <td class="px-3">€{{ $product->price }}</td>
            <td class="px-3">{{ $product->image ?? '-' }}</td>
            <td class="px-3">
                @if ($product->categories != null)
                    @foreach($product->categories as $category)
                        {{ $category->id }}
                    @endforeach
                @else
                    -
                @endif
            </td>
            <td class="px-3">{{ $product->visible ? __('names.yes') : __('names.no') }}</td>
            <td class="px-3">{{ $product->created_at }}</td>
            <td class="px-3">{{ $product->updated_at }}</td>
            <td class="px-3">
                <div class='btn-group w-100 d-flex justify-content-between align-items-center'>
                    <a href="{{ route('products.show', [$product->id]) }}"
                       class='btn btn-primary orders-returns-clear-button px-0'>
                        <i class="far fa-eye fs-5 mx-2"></i>
                    </a>
                    <a href="{{ route('products.edit', [$product->id]) }}"
                       class='btn btn-primary orders-returns-clear-button px-0'>
                        <i class="fa-solid fa-pen-to-square fs-5 mx-2"></i>
                    </a>
                    {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                    <button type="submit" class='btn btn-primary orders-returns-clear-button px-0'
                            onclick="return confirm('{{ __('messages.areYouSureDeleteProduct') }}')">
                        <i class="fa-solid fa-trash-can fs-5 mx-2"></i>
                    </button>
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-muted text-center">{{ __('names.noCategories') }}</td>
        </tr>
    @endforelse
    </tbody>
</table>


