<li class="nav-list">
    <a class="{{ request()->is("products*") ? 'active' : '' }}" href="{{ url("/products") }}">
        <i class="fa-solid fa-angle-right me-2"></i>
        {{ __('menu.products') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("rootcategories*") ? 'active' : '' }}" href="{{ url("/rootcategories") }}">
        <i class="fa-solid fa-angle-right me-2"></i>
        {{ __('menu.categories') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("promotions*") ? 'active' : '' }}" href="{{ url("/promotions") }}">
        <i class="fa-solid fa-angle-right me-2"></i>
        {{ __('menu.promotions') }}
    </a>
</li>
@auth
    <li class="nav-list">
        <a class="{{ request()->is("{$prefix}/discountCoupons*") ? 'active' : '' }}" href="{{ url("/{$prefix}/discountCoupons") }}">
            <i class="fa-solid fa-angle-right me-2"></i>
            {{ __('menu.discountCoupons') }}
        </a>
    </li>
    <li class="nav-list">
        <a class="{{ request()->is("{$prefix}/messenger*") ? 'active' : '' }}" href="{{ url("/{$prefix}/messenger") }}">
            <i class="fa-solid fa-angle-right me-2"></i>
            {{ __('menu.messenger') }}
        </a>
    </li>
@endauth
