<ul class="dropdown-menu" aria-labelledby="navbarUserDropdown" style="font-size: 1.1em">
    <li>
        <a class="dropdown-item" href="{{ url('/user/userprofile') }}"
           style="color: {{ request()->is('user/userprofile*') ? '#ffa600' : '' }}">
            {{__('menu.profile')}}
        </a>
    </li>
    <li>
        <a class="dropdown-item" href="{{ url('/user/rootorders') }}"
           style="color: {{ request()->is('user/rootorders*') ? '#ffa600' : '' }}">
            {{__('menu.orders')}}
        </a>
    </li>
    <li>
        <a class="dropdown-item" href="{{ url('/user/rootoreturns') }}"
           style="color: {{ request()->is('user/rootoreturns*') ? '#ffa600' : '' }}">
            {{__('menu.returns')}}
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
