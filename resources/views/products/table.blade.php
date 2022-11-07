<div class="table table-responsive">
    <table class="table" id="categories">
        <thead>
        <tr>
            <th>{{__('table.name')}}</th>
        <th>{{__('table.price')}}</th>
        <th>{{__('table.count')}}</th>
        <th>{{__('table.description')}}</th>
        <th>{{__('table.image')}}</th>
        <th>{{__('table.video')}}</th>
            <th>{{__('table.visible')}}</th>
            <th>{{__('table.promotionId')}}</th>
            <th>{{__('table.discountId')}}</th>
            <th>{{__('table.categories')}}</th>
            <th>{{__('table.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->count }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->image }}</td>
            <td>{{ $product->video }}</td>
            <td>{{ $product->visible }}</td>
            <td>{{ $product->promotion_id }}</td>
            <td>{{ $product->discount_id }}</td>
            <td>
                @if( $product->categories != null )
                    @foreach($product->categories as $c)
                        {{$c->id}}&nbsp;
                    @endforeach
                @else
                    ---
                @endif

            </td>


                <td width="120">
                    {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('products.show', [$product->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('products.edit', [$product->id]) }}"
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
