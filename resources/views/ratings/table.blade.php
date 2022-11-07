<div class="table-responsive">
    <table class="table" id="ratings-table">
        <thead>
        <tr>
            <th>Value</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ratings as $ratings)
            <tr>
                <td>{{ $ratings->value }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['ratings.destroy', $ratings->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('ratings.show', [$ratings->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('ratings.edit', [$ratings->id]) }}"
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
