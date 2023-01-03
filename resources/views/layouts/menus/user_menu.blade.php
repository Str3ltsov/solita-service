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
<li class="nav-list">
    <a class="{{ request()->is("{$prefix}/specialists*") ? 'active' : '' }}" href="{{ url("/{$prefix}/specialists") }}">
        {{ __('names.specialists') }}
    </a>
</li>
