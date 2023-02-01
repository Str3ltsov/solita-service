<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('/employee/product_panel*') ? 'active' : '' }}" href="/employee/product_panel">
        <i class="fa-solid fa-grip"></i>
        {{ __('menu.products') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('employee/orders*') ? 'active' : '' }}" href="/employee/orders">
        <i class="fa-solid fa-folder"></i>
        {{ __('menu.orders') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('employee/messenger') ? 'active' : '' }}" href="/employee/messenger">
        <i class="fa-solid fa-comment"></i>
        {{ __('menu.messenger') }}
    </a>
</li>
<li class="admin-navbar-item d-flex justify-content-between align-items-center">
    <a class="admin-navbar-link {{ request()->is('employee/notifications') ? 'active' : '' }}" href="/employee/notifications">
        <i class="fa-solid fa-bell"></i>
        {{ __('names.notifications') }}
    </a>
    @if (!empty($notificationCount))
        <span class="notification-count-employee">{{ $notificationCount }}</span>
    @endif
</li>

<style>
    .notification-count-employee {
        width: 16px;
        height: 16px;
        background-color: #f33535;
        border-radius: 10px;
        color: #fff;
        font-size: .7em;
        font-weight: 500;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 10px;
    }
</style>
