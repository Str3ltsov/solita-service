<ul class="dropdown-menu" aria-labelledby="navbarUserDropdown" style="font-size: 1.1em">
    <li>
        <a class="dropdown-item" href="{{ url("/{$prefix}/userprofile") }}"
           style="color: {{ request()->is("{$prefix}/userprofile*") ? '#ffa600' : '' }}">
            {{__('menu.profile')}}
        </a>
    </li>
    @if (Auth::user()->type == 4)
        <li>
            <a class="dropdown-item" href="{{ url("/{$prefix}/rootorders") }}"
               style="color: {{ request()->is("{$prefix}/rootorders*") ? '#ffa600' : '' }}">
                {{__('menu.orders')}}
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ url("/{$prefix}/rootoreturns") }}"
               style="color: {{ request()->is("{$prefix}/rootoreturns*") ? '#ffa600' : '' }}">
                {{__('menu.returns')}}
            </a>
        </li>
    @endif
    <li>
        <a class="dropdown-item" href="{{ route('userReviews', [auth()->user()->id]) }}"
           style="color: {{ request()->is("users/".auth()->user()->id."/reviews") ? '#ffa600' : '' }}">
            {{ __('names.reviews') }}
        </a>
    </li>
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
