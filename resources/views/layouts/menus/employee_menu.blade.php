<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('/employee/product_panel*') ? 'active' : '' }}"
       href="/employee/product_panel">
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
    <a class="admin-navbar-link {{ request()->is('employee/messages*') ? 'active' : '' }}" href="/employee/messages">
        <i class="fa-solid fa-comment"></i>
        {{ __('names.messages') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link dropdown {{
        request()->is('employee/notifications/system') ||
        request()->is('employee/notifications/user')
        ? 'active' : '' }}" href="#"
       data-bs-toggle="collapse" data-bs-target="#notifications" aria-expanded="false">
        <i class="fa-solid fa-bell"></i>
        {{ __('names.notifications') }}
        @if (!empty($totalNotificationCount))
            <span class="notification-count-staff">{{ $totalNotificationCount }}</span>
        @endif
    </a>
    <div class="collapse" id="notifications">
        <ul class="admin-navbar-item-dropdown">
            @include('layouts.dropdowns.staff_notification_dropdown')
        </ul>
    </div>
</li>
