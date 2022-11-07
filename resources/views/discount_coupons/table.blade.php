<div class="table table-responsive">
    <table class="table" id="categories">
        <thead>
        <tr>
            <th>{{__('table.code')}}</th>
            <th>{{__('table.used')}}</th>
            <th>{{__('table.user')}}</th>
            <th>{{__('table.value')}}</th>
            <th>{{__('table.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($discountCoupons as $discountCoupon)
            <tr>
                <td>{{ $discountCoupon->code }}</td>

            <td>{{ $discountCoupon->used }}</td>
            <td>{{ $discountCoupon->user->name ?? '-' }}</td></td>
            <td>{{ $discountCoupon->value }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['discountCoupons.destroy', $discountCoupon->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('discountCoupons.show', [$discountCoupon->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('discountCoupons.edit', [$discountCoupon->id]) }}"
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
