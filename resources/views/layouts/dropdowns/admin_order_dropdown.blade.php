<li class="admin-navbar-subitem">
    <a class="admin-navbar-sublink {{ request()->is('admin/orders') ? 'subactive' : '' }}"
       href="/admin/orders">
        {{ __('menu.orders') }}
    </a>
</li>
{{--<a class="dropdown-item" href="/admin/orderItems">OrderItems</a>&nbsp;&nbsp;--}}
<li class="admin-navbar-subitem">
    <a class="admin-navbar-sublink {{ request()->is('admin/orderStatuses') ? 'subactive' : '' }}"
       href="/admin/orderStatuses">
        {{__('menu.orderStatuses')}}
    </a>
</li>
