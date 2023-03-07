{!! Form::open(['route' => ['messages.store', $prefix], 'method' => 'post', 'class' => 'd-flex flex-column']) !!}
    <div class="row">
        <input type="hidden" name="sender_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="reply_message_id" value="{{ null }}">
        <input type="hidden" name="main_message_id" value="{{ null }}">
        <div class="form-group col-12">
            {!! Form::label('topic', __('table.title')) !!}
            {!! Form::text('topic', null, ['class' => 'form-control', 'style' => 'padding: 14px; font-size: 1em; border-color: #eeeeee; border-radius: 0']) !!}
        </div>
        <div class="form-group col-md-6 col-12">
            {!! Form::label('order_id', __('names.order')) !!}
            {!! Form::select('order_id', $orderList, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
        <div class="form-group col-md-3 col-12">
            {!! Form::label('message_type_id', __('names.messageType')) !!}
            {!! Form::select('message_type_id', $typeList, null, ['class' => 'form-select', 'style' => 'padding: 15px;']) !!}
        </div>
        <div class="form-group col-md-3 col-12">
            {!! Form::label('users', __('names.users')) !!}
            {!! Form::select('users', [], null, ['class' => 'form-select', 'name' => 'users[]', 'multiple', 'style' => 'height: 50px; padding: 6px;']) !!}
        </div>
        <div class="form-group col-12">
            {!! Form::label('description', __('table.description')) !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'style' => 'padding: 14px; font-size: 1em; border-color: #eeeeee; border-radius: 0']) !!}
        </div>
    <div class="d-flex align-items-center justify-content-center mt-4 col-12">
        <button type="submit" class='btn btn-primary orders-returns-primary-button col-lg-4 col-md-6 col-12'>
            {{ __('messages.send') }}
        </button>
    </div>
{!! Form::close() !!}

@push('scripts')
    <script>
        $(document).ready(() => {
            const orderSelector = document.querySelector('select[name="order_id"]')

            const getOrderUsers = () => {
                let data = {
                    '_token': "{{ csrf_token() }}",
                    'orderId': $(orderSelector).val(),
                };

                $.ajax({
                    url: '{{ route('orderUsers', $prefix) }}',
                    type: 'GET',
                    data: data,
                    dataType: 'html',
                    success: response => {
                        const users = JSON.parse(response).users
                        const userSelector = document.querySelector('select[name="users[]"]')

                        userSelector.replaceChildren('')

                        for (const user of Object.entries(users)) {
                            let option = document.createElement('option');

                            option.value = user[0];
                            option.append(user[1].toString());
                            userSelector.appendChild(option);
                        }
                    },
                    error: (XMLHttpRequest, textStatus, errorThrown) => {
                        console.error(XMLHttpRequest.responseText)
                    }
                });
            }

            getOrderUsers();

            $(orderSelector).on('change', event => {
                event.preventDefault();
                getOrderUsers();
            });
        });
    </script>
@endpush
