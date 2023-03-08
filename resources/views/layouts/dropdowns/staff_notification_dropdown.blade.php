<li class="admin-navbar-subitem">
    @if (auth()->user()->type == 1)
        <a class="admin-navbar-sublink d-flex align-items-center {{ request()->is('admin/notifications/system') ? 'subactive' : '' }}"
           href="/admin/notifications/system">
            @if (!empty($systemNotificationCount))
                <span class="sub-notification-count-staff me-2 ms-0">{{ $systemNotificationCount }}</span>
            @endif
            {{ __('names.systemNotifications') }}
        </a>
    @elseif (auth()->user()->type == 2)
        <a class="admin-navbar-sublink d-flex align-items-center {{ request()->is('specialist/notifications/system') ? 'subactive' : '' }}"
           href="/specialist/notifications/system">
            @if (!empty($systemNotificationCount))
                <span class="sub-notification-count-staff me-2 ms-0">{{ $systemNotificationCount }}</span>
            @endif
            {{ __('names.systemNotifications') }}
        </a>
    @elseif (auth()->user()->type == 3)
        <a class="admin-navbar-sublink d-flex align-items-center {{ request()->is('employee/notifications/system') ? 'subactive' : '' }}"
           href="/employee/notifications/system">
            @if (!empty($systemNotificationCount))
                <span class="sub-notification-count-staff me-2 ms-0">{{ $systemNotificationCount }}</span>
            @endif
            {{ __('names.systemNotifications') }}
        </a>
    @endif
</li>
<li class="admin-navbar-subitem">
    @if (auth()->user()->type == 1)
        <a class="admin-navbar-sublink d-flex align-items-center {{ request()->is('admin/notifications/user') ? 'subactive' : '' }}"
           href="/admin/notifications/user">
            @if (!empty($userNotificationCount))
                <span class="sub-notification-count-staff me-2 ms-0">{{ $userNotificationCount }}</span>
            @endif
            {{ __('names.userNotifications') }}
        </a>
    @elseif (auth()->user()->type == 2)
        <a class="admin-navbar-sublink d-flex align-items-center {{ request()->is('specialist/notifications/user') ? 'subactive' : '' }}"
           href="/specialist/notifications/user">
            @if (!empty($userNotificationCount))
                <span class="sub-notification-count-staff me-2 ms-0">{{ $userNotificationCount }}</span>
            @endif
            {{ __('names.userNotifications') }}
        </a>
    @elseif (auth()->user()->type == 3)
        <a class="admin-navbar-sublink d-flex align-items-center {{ request()->is('employee/notifications/user') ? 'subactive' : '' }}"
           href="/employee/notifications/user">
            @if (!empty($userNotificationCount))
                <span class="sub-notification-count-staff me-2 ms-0">{{ $userNotificationCount }}</span>
            @endif
            {{ __('names.userNotifications') }}
        </a>
    @endif
</li>
