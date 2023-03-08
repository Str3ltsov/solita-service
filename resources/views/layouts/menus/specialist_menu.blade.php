<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('specialist/orders*') ? 'active' : '' }}" href="/specialist/orders">
        <i class="fa-solid fa-folder"></i>
        {{ __('menu.orders') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('specialist/messages*') ? 'active' : '' }}"
       href="/specialist/messages">
        <i class="fa-solid fa-comment"></i>
        {{ __('names.messages') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link dropdown {{
        request()->is('specialist/notifications/system') ||
        request()->is('specialist/notifications/user')
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
