<li class="admin-navbar-subitem">
    <a class="admin-navbar-sublink {{ request()->is('admin/discounts') ? 'subactive' : '' }}" href="/admin/discounts">
        {{ __('menu.discounts') }}
    </a>
</li>
<li class="admin-navbar-subitem">
    <a class="admin-navbar-sublink {{ request()->is('admin/discountCoupons') ? 'subactive' : '' }}" href="/admin/discountCoupons">
        {{ __('menu.discountCoupons') }}
    </a>
</li>
