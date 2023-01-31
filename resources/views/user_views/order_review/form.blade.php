{!! Form::open(['route' => ['postOrderReview', [$prefix, $order->id]], 'method' => 'post', 'class' => 'product-review-add-review-form', 'id' => "review-user"]) !!}
    @csrf
    <div class="col-12 d-flex flex-column gap-4">
        <div class="row bg-white">
            {{ Form::hidden('user_id', auth()->user()->id) }}
            {{ Form::hidden('order_id', $order->id) }}
            @foreach($orderQuestions as $question)
                <div class="form-group col-12 my-3">
                    {{ Form::hidden("question[{$loop->index}][id]", $question->id) }}
                    {!! Form::label("question.[{$loop->index}][id]", $question->id.'. '.$question->question, ['class' => 'fw-bold mb-2 fs-6']) !!}
                    @if (!$loop->first)
                        {!! Form::textarea("question[{$loop->index}][answer]", null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => __('names.answer')]) !!}
                    @else
                        <div class="rating m-0" style="gap: 5px">
                            <input type="radio" name="question[0][answer]" value="5" id="5">
                            <label for="5">
                                <i class="fa-regular fa-star"></i>
                            </label>
                            <input type="radio" name="question[0][answer]" value="4" id="4">
                            <label for="4">
                                <i class="fa-regular fa-star"></i>
                            </label>
                            <input type="radio" name="question[0][answer]" value="3" id="3">
                            <label for="3">
                                <i class="fa-regular fa-star"></i>
                            </label>
                            <input type="radio" name="question[0][answer]" value="2" id="2">
                            <label for="2">
                                <i class="fa-regular fa-star"></i>
                            </label>
                            <input type="radio" name="question[0][answer]" value="1" id="1">
                            <label for="1">
                                <i class="fa-regular fa-star"></i>
                            </label>
                        </div>
                    @endif
                    @if ($errors->get("question.{$loop->index}.answer"))
                        <span class="text-danger fw-bold fade-in">
                            {{ $errors->first("question.{$loop->index}.answer") }}
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="col-xl-3 col-lg-5 col-md-6 col-12 category-return-button" data-loading-text="Loading...">
                {{ __('buttons.placeOrder') }}
            </button>
        </div>
    </div>
{!! Form::close() !!}

@push('css')
    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .rating > input {
            display: none;
        }

        .rating > label {
            position: relative;
            width: 1em;
            font-size: 1.5em;
            color: #fcb600;
            cursor: pointer;
        }

        .rating > label::before {
            content: "\2605";
            position: absolute;
            padding-left: 1px;
            opacity: 0;
        }

        .rating > label:hover:before,
        .rating > label:hover ~ label:before {
            opacity: 1 !important
        }

        .rating > input:checked ~ label:before {
            opacity: 1
        }

        .rating:hover > input:checked ~ label:before {
            opacity: 0.4
        }
    </style>
@endpush
