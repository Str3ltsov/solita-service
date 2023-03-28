<li class="nav-list pt-md-2">
    <a class="{{ request()->is('products*') || request()->is("viewproduct*") ? 'active' : '' }}" href="{{ url('/products') }}">
        {{ __('menu.products') }}
    </a>
</li>
<li class="nav-list pt-md-2">
    <a class="{{ request()->is('rootcategories*') || request()->is("innercategories*") ? 'active' : '' }}" href="{{ url('/rootcategories') }}">
        {{ __('menu.categories') }}
    </a>
</li>

