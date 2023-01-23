<table class="table table-striped table-bordered my-3" id="categories">
    <thead style="background: #e7e7e7;">
    <tr>
        <th class="text-center px-3">#</th>
        <th class="px-3">{{__('table.specialist')}}</th>
        <th class="px-3">{{__('forms.hourly_price')}}</th>
        <th class="px-3">{{ __('names.rating') }}</th>
        <th class="px-3">{{__('table.totalHours')}}</th>
        <th class="px-3">{{__('table.completeHours')}}</th>
        <th class="px-3">{{__('table.completePercentage')}}</th>
        <th class="px-3"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->specialists as $specialist)
        <tr>
            <td class="px-3">{{ $loop->index + 1 }}</td>
            <td class="px-3">{{ $specialist->user->name }}</td>
            <td class="px-3">€{{ number_format($specialist->user->hourly_price, 2) }}</td>
            <td class="px-3">
                <div class="d-flex align-items-center">
                    <span>{{ round(number_format($reviewAverageRating['specialists'][$loop->index], 2), 1) }}</span>
                    <span>/</span>
                    <span>5</span>
                    @if ($reviewAverageRating > 0)
                        <i class="fa-solid fa-star text-warning ms-1"></i>
                    @else
                        <i class="fa-regular fa-star text-warning ms-1"></i>
                    @endif
                </div>
            </td>
            <td class="px-3">
                <span id="specHoursSpan">{{ $specialist->hours.' '.__('table.hour') }}</span>
                <input type="number" name="hours" value="{{ $specialist->hours }}" min="1"
                       id="specHoursInput" class="form-control" style="width: 80px" oninput="setSpecHours();">
            </td>
            <td class="px-3">{{ $specialist->complete_hours.' '.__('table.hour') }}</td>
            <td class="p-3">
                <div class="complete-percentage-wrapper">
                    <span>{{ number_format($specialist->complete_percentage, 2).' %' }}</span>
                    <div style="width: {{ $specialist->complete_percentage }}%"></div>
                </div>
            </td>
            <td class="px-3">
                <div class='btn-group w-100 d-flex justify-content-between align-items-center gap-2 gap-lg-1'>
                    <a href="{{ route('userReviews', [$specialist->user->id]) }}"
                       class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'>
                        <i class="far fa-eye fs-5"></i>
                    </a>
                    <button type="button" onclick="showEditSpecHours({{ $loop->index }});"
                            class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'>
                        <i class="fa-solid fa-pen-to-square fs-5"></i>
                    </button>
                    {!! Form::open(['route' => ['deleteOrderSpecialist', $specialist->id], 'method' => 'delete']) !!}
                        <button type="submit" class='btn btn-primary orders-returns-primary-button px-0 bg-transparent'
                                onclick="return confirm('{{ __('messages.areYouSureDeleteOrderSpec') }}')">
                            <i class="fa-solid fa-trash-can fs-5"></i>
                        </button>
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@push('css')
    <style>
        .complete-percentage-wrapper {
            border: 1px solid #ccc;
            background: #fff;
            transition: all 500ms ease;
            position: relative;
            min-width: 100px;
        }

        .complete-percentage-wrapper span {
            position: absolute;
            top: -2px;
            left: calc(100% / 3.2);
            color: #222;
            font-weight: 600;
        }

        .complete-percentage-wrapper div {
            height: 25px;
            background: #fcb200;
        }
    </style>
@endpush
