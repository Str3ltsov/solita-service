<table class="table table-striped table-bordered my-3">
    <thead style="background: #e7e7e7;">
    <tr>
        <th class="text-center px-3">#</th>
        <th class="px-3">{{__('table.productName')}}</th>
        <th class="px-3">{{__('table.count')}}</th>
        <th class="px-3">{{__('table.price')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($returnItems as $returnItem)
        <tr>
            <td class="text-center px-3">{{ $loop->index + 1 }}</td>
            <td class="px-3">{{ $returnItem->product->name }}</td>
            <td class="px-3">{{ $returnItem->count }}</td>
            <td class="px-3">{{ number_format($returnItem->price_current, 2) }} €</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot style="background: #e7e7e7;">
        <tr class="fw-bold" style="border-top: 2px solid black">
            <td class="px-3 text-center">#</td>
            <td class="px-3">{{ __('names.total') }}</td>
            <td class="px-3">{{ $returnItemCountSum }}</td>
            <td class="px-3">{{ number_format($returnItemPriceSum, 2) }} €</td>
        </tr>
    </tfoot>
</table>
