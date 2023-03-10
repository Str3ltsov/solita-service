<table class="table table-striped my-3">
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
            <td class="px-3">€{{ number_format($specialist->user->hourly_price, 2) ?? '-' }}</td>
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
            <td class="px-3">{{ $specialist->hours.' '.__('table.hour') ?? '-' }}</td>
            <td class="px-3">{{ $specialist->complete_hours.' '.__('table.hour') ?? '-' }}</td>
            <td class="p-3">
                <div class="complete-percentage-wrapper">
                    <span>{{ number_format($specialist->complete_percentage, 2).' %' ?? '-' }}</span>
                    <div style="width: {{ $specialist->complete_percentage }}%"></div>
                </div>
            </td>
            <td class="px-3">
                <div class='btn-group w-100 d-flex justify-content-center align-items-center'>
                    <a href="{{ route('userReviews', $specialist->user->id) }}"
                       class='btn btn-primary orders-returns-primary-button'>
                        <i class="fa-solid fa-star me-1"></i>
                        {{ __('names.reviews') }}
                    </a>
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
        }

        .complete-percentage-wrapper span {
            position: absolute;
            top: -2px;
            left: calc(100% / 3.5);
            color: #fff;
            -webkit-text-stroke-width: .8px;
            -webkit-text-stroke-color: #0a0c0d;
            font-weight: 800;
        }

        .complete-percentage-wrapper div {
            height: 25px;
            background-image: linear-gradient(to right, #0E84E1,  #6551B3,  #6551B3, #0E84E1);
            background-size: 300% 100%;
        }
    </style>
@endpush
