<div class="table-responsive">
    <table class="table" id="cartItems-table">
        <thead>
        <tr>
            <th>{{__('table.cartId')}}</th>
            <th>{{__('table.product')}}</th>
            <th>{{__('table.price')}}</th>
            <th>{{__('table.count')}}</th>
            <th colspan="3">{{__('table.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cartItems as $cartItem)
            <tr>
                <td>{{ $cartItem->cart_id }}</td>
                <td>{{ $cartItem->product->name }}</td>
                <td>{{ $cartItem->price_current }}</td>
                <td>{{ $cartItem->count }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cartItems.destroy', $cartItem->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cartItems.show', [$cartItem->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cartItems.edit', [$cartItem->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
