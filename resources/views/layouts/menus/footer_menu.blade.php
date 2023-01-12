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
