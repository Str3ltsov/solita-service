<li class="nav-list">
    <a class="{{ request()->is("products*") ? 'active' : '' }}" href="{{ url("/products") }}">
        {{ __('menu.products') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("rootcategories*") ? 'active' : '' }}" href="{{ url("/rootcategories") }}">
        {{ __('menu.categories') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("promotions*") ? 'active' : '' }}" href="{{ url("/promotions") }}">
        {{ __('menu.promotions') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("{$prefix}/discountCoupons*") ? 'active' : '' }}" href="{{ url("/{$prefix}/discountCoupons") }}">
        {{ __('menu.discountCoupons') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("{$prefix}/messenger*") ? 'active' : '' }}" href="{{ url("/{$prefix}/messenger") }}">
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
@if (Auth::user()->type == 2)
    <li class="nav-list">
        <a class="{{ request()->is('specialist/returns*') ? 'active' : '' }}" href="{{ url('/specialist/returns') }}">
            {{ __('menu.returns') }}
        </a>
    </li>
@elseif (Auth::user()->type == 3)
    <li class="nav-list">
        <a class="{{ request()->is('employee/returns*') ? 'active' : '' }}" href="{{ url('/employee/returns') }}">
            {{ __('menu.returns') }}
        </a>
    </li>
@endif
