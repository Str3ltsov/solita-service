<li class="admin-navbar-subitem">
    <a class="admin-navbar-sublink {{ request()->is('admin/orders') ? 'subactive' : '' }}"
       href="/admin/orders">
        {{ __('menu.orders') }}
    </a>
</li>
{{--<a class="dropdown-item" href="/admin/orderItems">OrderItems</a>&nbsp;&nbsp;--}}
{{--<li class="admin-navbar-subitem">--}}
{{--    <a class="admin-navbar-sublink {{ request()->is('admin/orderStatuses') ? 'subactive' : '' }}"--}}
{{--       href="/admin/orderStatuses">--}}
{{--        {{__('menu.orderStatuses')}}--}}
{{--    </a>--}}
{{--</li>--}}
{{--<li class="admin-navbar-subitem">--}}
{{--    <a class="admin-navbar-sublink {{ request()->is('admin/orderPriorities') ? 'subactive' : '' }}"--}}
{{--       href="/admin/orderPriorities">--}}
{{--        {{__('names.orderPriorities')}}--}}
{{--    </a>--}}
{{--</li>--}}
<li class="admin-navbar-subitem">
    <a class="admin-navbar-sublink {{ request()->is('admin/orderQuestions') ? 'subactive' : '' }}"
       href="/admin/orderQuestions">
        {{__('names.orderQuestions')}}
    </a>
</li>

