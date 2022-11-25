<form action="{{ route('postUserReview', [$user->id]) }}" method="post"
      class="col product-review-add-review-form"  id="review-user">
    @csrf
    @guest
        <p class="product-reviews-add-review-description">{{ __('names.loginToReview') }}</p>
    @else
        <input type="hidden" name="user_from_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="user_to_id" value="{{ $user->id }}">
        <div class="col-sm-12">
            <label class="form-label required text-dark fw-bold">
                {{ __('names.rating') }}
                <span>*</span>
            </label>
            <div class="rating" style="gap: 5px">
                <input type="radio" name="rating" value="5" id="5"><label for="5">
                    <i class="fa-regular fa-star"></i>
                </label>
                <input type="radio" name="rating" value="4" id="4"><label for="4">
                    <i class="fa-regular fa-star"></i>
                </label>
                <input type="radio" name="rating" value="3" id="3"><label for="3">
                    <i class="fa-regular fa-star"></i>
                </label>
                <input type="radio" name="rating" value="2" id="2"><label for="2">
                    <i class="fa-regular fa-star"></i>
                </label>
                <input type="radio" name="rating" value="1" id="1"><label for="1">
                    <i class="fa-regular fa-star"></i>
                </label>
            </div>
        </div>
        <div class="col-sm-12">
            <label class="form-label required text-dark fw-bold" for="review">
                {{ __('names.review') }}
            </label>
            <div class="mb-3">
                <textarea class="form-control" rows="5" id="review" name="review"></textarea>
            </div>
        </div>
        <div class="col-sm-12">
            <button type="submit" class="product-reviews-add-review-submit">
                {{ __('buttons.postReview') }}
            </button>
        </div>
    @endguest
</form>
