<ul class="dropdown-menu" aria-labelledby="navbarUserDropdown" style="font-size: 1.1em">
    <li>
        <a class="dropdown-item" href="{{ url("/{$prefix}/userprofile") }}"
           style="color: {{ request()->is("{$prefix}/userprofile*") ? '#0E84E1' : '' }}">
            {{__('menu.profile')}}
        </a>
    </li>
    @if (Auth::user()->type == 4)
        <li>
            <a class="dropdown-item" href="{{ url("/{$prefix}/rootorders") }}"
               style="color: {{ request()->is("{$prefix}/rootorders*") ? '#0E84E1' : '' }}">
                {{__('menu.orders')}}
            </a>
        </li>
    @endif
    @if (Auth::user()->type != 1)
        <li>
            <a class="dropdown-item" href="{{ route('userReviews', [auth()->user()->id]) }}"
               style="color: {{ request()->is("users/".auth()->user()->id."/reviews") ? '#0E84E1' : '' }}">
                {{ __('names.reviews') }}
            </a>
        </li>
    @endif
    <li><hr class="dropdown-divider"></li>
    <li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('menu.logout') }}
            </a>
        </form>
    </li>
</ul>
