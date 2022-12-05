<li class="nav-list">
    <a class="{{ request()->is('products*') ? 'active' : '' }}" href="{{ url('/products') }}">
        {{ __('menu.products') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is('rootcategories*') ? 'active' : '' }}" href="{{ url('/rootcategories') }}">
        {{ __('menu.categories') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is('promotions*') ? 'active' : '' }}" href="{{ url('/promotions') }}">
        {{ __('menu.promotions') }}
    </a>
</li>

