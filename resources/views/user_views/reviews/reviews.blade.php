<ul class="comments">
    @forelse ($reviews as $review)
        <li>
            <div class="comment">
                <div class="comment-block">
                    <div class="comment-arrow"></div>
                    <span class="comment-by">
                        <strong>{{ $review->userFrom->name }}</strong>
                        <span class="mx-1">–</span>
                        <span>{{ $review->created_at->format('F j, Y') }}</span>
                        <span class="float-end">
                            <div class="pb-0 comment-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="product-rating-star @if ($review->rating >= $i) fa-solid fa-star
                                       @elseif ($review->rating >= $i - .5) fa-solid fa-star-half-stroke
                                       @else fa-regular fa-star @endif"></i>
                                @endfor
                            </div>
                        </span>
                    </span>
                    @if ($review->review)
                        <p class="m-0 comment-description">{{ $review->review }}</p>
                    @endif
                </div>
            </div>
        </li>
    @empty
        <p class="text-muted">{{ __('names.noReviews') }}</p>
    @endforelse
</ul>
