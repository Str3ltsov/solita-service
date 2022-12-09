<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('admin/products') ? 'active' : '' }}" href="/admin/products">
        <i class="fa-solid fa-grip"></i>
        {{ __('menu.products') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('admin/categories') ? 'active' : '' }}" href="/admin/categories">
        <i class="fa-solid fa-sitemap"></i>
        {{ __('menu.categories') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('admin/promotions') ? 'active' : '' }}" href="/admin/promotions">
        <i class="fa-solid fa-star"></i>
        {{ __('menu.promotions') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link dropdown {{
        request()->is('admin/discounts') ||
        request()->is('admin/discountCoupons')
        ? 'active' : '' }}" href="#"
            data-bs-toggle="collapse" data-bs-target="#discounts" aria-expanded="false">
        <i class="fa-solid fa-tag"></i>
        {{ __('menu.discounts') }}
    </a>
    <div class="collapse" id="discounts">
        <ul class="admin-navbar-item-dropdown">
            @include('layouts.dropdowns.admin_discount_dropdown')
        </ul>
    </div>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link dropdown {{
        request()->is('admin/customers') ||
        request()->is('admin/roles')
        ? 'active' : '' }}" href="#"
       data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="false">
        <i class="fa-solid fa-user"></i>
        {{ __('menu.users') }}
    </a>
    <div class="collapse" id="users">
        <ul class="admin-navbar-item-dropdown">
            @include('layouts.dropdowns.admin_users_dropdown')
        </ul>
    </div>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link dropdown {{
            request()->is('admin/carts') ||
            request()->is('admin/cartStatuses')
            ? 'active' : '' }}" href="#"
       data-bs-toggle="collapse" data-bs-target="#carts" aria-expanded="false">
        <i class="fa-solid fa-cart-shopping"></i>
        {{ __('menu.carts') }}
    </a>
    <div class="collapse" id="carts">
        <ul class="admin-navbar-item-dropdown">
            @include('layouts.dropdowns.admin_cart_dropdown')
        </ul>
    </div>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link dropdown {{
            request()->is('admin/orders') ||
            request()->is('admin/orderStatuses')
            ? 'active' : '' }}" href="#"
       data-bs-toggle="collapse" data-bs-target="#orders" aria-expanded="false">
        <i class="fa-solid fa-folder"></i>
        {{ __('menu.orders') }}
    </a>
    <div class="collapse" id="orders">
        <ul class="admin-navbar-item-dropdown">
            @include('layouts.dropdowns.admin_order_dropdown')
        </ul>
    </div>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link dropdown {{
            request()->is('admin/returns') ||
            request()->is('admin/returnStatuses')
            ? 'active' : '' }}" href="#"
       data-bs-toggle="collapse" data-bs-target="#returns" aria-expanded="false">
        <i class="fa-solid fa-rotate-left"></i>
        {{ __('menu.returns') }}
    </a>
    <div class="collapse" id="returns">
        <ul class="admin-navbar-item-dropdown">
            @include('layouts.dropdowns.admin_return_dropdown')
        </ul>
    </div>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('admin/cookies') ? 'active' : '' }}" href="/admin/cookies">
        <i class="fa-solid fa-cookie-bite"></i>
        {{ __('menu.cookies') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('admin/data_export_import') ? 'active' : '' }}" href="/admin/data_export_import">
        <i class="fa-solid fa-file"></i>
        {{ __('menu.importExport') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link dropdown {{
        request()->is('admin/orders_report') ||
        request()->is('admin/returns_report') ||
        request()->is('admin/carts_report') ||
        request()->is('admin/users_report') ||
        request()->is('admin/user_activities_report') ?
        'active' : '' }}" href="#"
            data-bs-toggle="collapse" data-bs-target="#reports" aria-expanded="false">
        <i class="fa-solid fa-id-card-clip"></i>
        {{ __('menu.reports') }}
    </a>
    <div class="collapse" id="reports">
        <ul class="admin-navbar-item-dropdown">
            @include('layouts.dropdowns.admin_report_dropdown')
        </ul>
    </div>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('admin/analysis_chart') ? 'active' : '' }}" href="/admin/analysis_chart">
        <i class="fa-solid fa-chart-line"></i>
        {{ __('menu.analysisChart') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('admin/messenger') ? 'active' : '' }}" href="/admin/messenger">
        <i class="fa-solid fa-comment"></i>
        {{ __('menu.messenger') }}
    </a>
</li>
