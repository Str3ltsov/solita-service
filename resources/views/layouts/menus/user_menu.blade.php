<li class="nav-list">
    <a class="{{ request()->is("products*") || request()->is("viewproduct*") ? 'active' : '' }}"
       href="{{ url("/products") }}">
        {{ __('menu.products') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("rootcategories*") || request()->is("innercategories*") ? 'active' : '' }}"
       href="{{ url("/rootcategories") }}">
        {{ __('menu.categories') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("{$prefix}/specialists*") || request()->is("users/".auth()->user()->id."/reviews") ? 'active' : '' }}"
       href="{{ url("/{$prefix}/specialists") }}">
        {{ __('names.specialists') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("{$prefix}/create_order") ? 'active' : '' }}"
       href="{{ url("/{$prefix}/create_order") }}">
        {{ __('buttons.order') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("{$prefix}/messages*") ? 'active' : '' }}"
       href="{{ url("/{$prefix}/messages") }}">
        {{ __('names.messages') }}
    </a>
</li>
