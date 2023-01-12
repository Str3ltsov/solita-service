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
    <a class="{{ request()->is("{$prefix}/specialists*") ? 'active' : '' }}" href="{{ url("/{$prefix}/specialists") }}">
        {{ __('names.specialists') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("{$prefix}/messenger*") ? 'active' : '' }}" href="{{ url("/{$prefix}/messenger") }}">
        {{ __('menu.messenger') }}
    </a>
</li>
