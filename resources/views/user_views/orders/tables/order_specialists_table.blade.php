<table class="table table-striped my-3">
    <thead style="background: #e7e7e7;">
    <tr>
        <th class="text-center px-3">#</th>
        <th class="px-3">{{__('table.specialist')}}</th>
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
            <td class="px-3">
                <div class="d-flex align-items-center">
                    <span>{{ round(number_format($specialist->user->average_rating, 2), 1) ?? 0 }}</span>
                    <span>/</span>
                    <span>5</span>
                    @if ($specialist->user->average_rating > 0)
                        <i class="fa-solid fa-star text-warning ms-1"></i>
                    @else
                        <i class="fa-regular fa-star text-warning ms-1"></i>
                    @endif
                </div>
            </td>
            <td class="px-3">{{ $specialist->hours.' '.__('table.hour') ?? '-' }}</td>
            <td class="px-3">{{ $specialist->complete_hours.' '.__('table.hour') ?? '-' }}</td>
            <td class="p-3" style="min-width: 150px">
                <div class="complete-percentage-wrapper">
                    <span style="left: 30%">{{ number_format($specialist->complete_percentage, 2).' %' ?? '-' }}</span>
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
