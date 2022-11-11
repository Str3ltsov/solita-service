<li class="admin-navbar-subitem">
    <a class="admin-navbar-sublink {{ request()->is('admin/customers') ? 'subactive' : '' }}" href="/admin/customers">
        {{ __('menu.users') }}
    </a>
</li>
<li class="admin-navbar-subitem">
    <a class="admin-navbar-sublink {{ request()->is('admin/roles') ? 'subactive' : '' }}" href="/admin/roles">
        {{ __('names.userTypes') }}
    </a>
</li>
