<li class="admin-navbar-subitem">
    <a class="admin-navbar-sublink {{ request()->is('admin/orders_report') ? 'subactive' : '' }}"
       href="/admin/orders_report">
        {{ __('menu.ordersReport') }}
    </a>
</li>
<li class="admin-navbar-subitem">
    <a class="admin-navbar-sublink {{ request()->is('admin/users_report') ? 'subactive' : '' }}"
       href="/admin/users_report">
        {{ __('menu.usersReport') }}
    </a>
</li>
<li class="admin-navbar-subitem">
    <a class="admin-navbar-sublink {{ request()->is('admin/user_activities_report') ? 'subactive' : '' }}"
       href="/admin/user_activities_report">
        {{ __('menu.usersActivitiesReport') }}
    </a>
</li>
