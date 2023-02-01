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
@auth
    <li class="nav-list">
        <a class="{{ request()->is("{$prefix}/specialists*") ? 'active' : '' }}" href="{{ url("/{$prefix}/specialists") }}">
            <i class="fa-solid fa-angle-right me-2"></i>
            {{ __('names.specialists') }}
        </a>
    </li>
    <li class="nav-list">
        <a class="{{ request()->is("{$prefix}/create_order") ? 'active' : '' }}" href="{{ url("/{$prefix}/create_order") }}">
            <i class="fa-solid fa-angle-right me-2"></i>
            {{ __('buttons.order') }}
        </a>
    </li>
    <li class="nav-list">
        <a class="{{ request()->is("{$prefix}/messenger*") ? 'active' : '' }}" href="{{ url("/{$prefix}/messenger") }}">
            <i class="fa-solid fa-angle-right me-2"></i>
            {{ __('menu.messenger') }}
        </a>
    </li>
@endauth
