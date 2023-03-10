<table class="table table-striped my-3" id="categories">
    <thead style="background: #e7e7e7;">
    <tr>
        <th class="text-center px-3">#</th>
        <th class="px-3 w-75">{{ __('names.skill') }}</th>
        <th class="px-3 w-25">{{ __('names.experience').' ('.__('names.years').')' }}</th>
        <th class="px-3"></th>
    </tr>
    </thead>
    <tbody>
        @forelse ($customer->skillsUsers as $skillUser)
            <tr>
                <td class="text-center px-3">{{ $loop->index + 1 }}</td>
                <td class="px-3">{{ $skillUser->skill->name }}</td>
                <td class="px-3">{{ $skillUser->experience }}</td>
                <td class="px-3">
                    <div class='btn-group w-100 d-flex justify-content-center align-items-center'>
                        {!! Form::open(['route' => ['adminRemoveSkill', $skillUser->id], 'method' => 'delete']) !!}
                            <button type="submit" class='btn btn-primary orders-returns-clear-button px-0'
                                    onclick="return confirm('{{ __('messages.AreYouSureDeleteSkill') }}')">
                                <i class="fa-solid fa-trash-can fs-5 mx-2"></i>
                            </button>
                        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-muted text-center">{{ __('names.noSkills') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
