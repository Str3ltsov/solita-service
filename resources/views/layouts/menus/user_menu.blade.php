<li class="nav-list">
    <a class="{{ request()->is('user/products*') ? 'active' : '' }}" href="{{ url('/user/products') }}">
        {{ __('menu.products') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is('user/rootcategories*') ? 'active' : '' }}" href="{{ url('/user/rootcategories') }}">
        {{ __('menu.categories') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is('user/promotions*') ? 'active' : '' }}" href="{{ url('/user/promotions') }}">
        {{ __('menu.promotions') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is('user/discountCoupons*') ? 'active' : '' }}" href="{{ url('/user/discountCoupons') }}">
        {{ __('menu.discountCoupons') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is('user/messenger*') ? 'active' : '' }}" href="{{ url('/user/messenger') }}">
        {{ __('menu.messenger') }}
    </a>
</li>
@if (Auth::user()->type == 2)
    <li class="nav-list">
        <a class="{{ request()->is('specialist/orders*') ? 'active' : '' }}" href="{{ url('/specialist/orders') }}">
            {{ __('menu.orders') }}
        </a>
    </li>
@elseif (Auth::user()->type == 3)
    <li class="nav-list">
        <a class="{{ request()->is('employee/orders*') ? 'active' : '' }}" href="{{ url('/employee/orders') }}">
            {{ __('menu.orders') }}
        </a>
    </li>
@endif
