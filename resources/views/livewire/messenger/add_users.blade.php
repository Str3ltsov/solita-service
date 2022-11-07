<ul class="list-unstyled">
    @forelse ($addUsers as $user)
        <li>
            <div class="messenger-add-users-user flex-column flex-sm-row">
                <div class="mb-3 mb-sm-0">
                    <p class="messenger-add-users-name mb-0">
                        {{ $user->name }}
                        <span class="text-muted">
                            @if ($user->type == 1) ({{ __('admin') }}) @else ({{ __('user') }}) @endif
                        </span>
                    </p>
                    <p class="messenger-add-users-email mb-0">{{ $user->email }}</p>
                </div>
                <a class="messenger-add-users-button" href="{{ route('livewire.messenger.show', [$user->id]) }}">
                    {{ __('buttons.contact') }}
                </a>
            </div>
        </li>
        <hr class="messenger-users-hr my-0"/>
    @empty
        <div>
            <span class="text-muted">{{ __('names.noUncontactedUsers') }}</span>
        </div>
    @endforelse
    @if (count($addUsers) > 5)
        <div class="pt-3 mt-3">
            {{ $addUsers->links() }}
        </div>
    @endif
</ul>
