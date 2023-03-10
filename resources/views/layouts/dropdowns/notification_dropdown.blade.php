<ul class="dropdown-menu" aria-labelledby="navbarNotificationDropdown" style="font-size: 1.1em">
    <li>
        <a class="dropdown-item d-flex align-items-center" href="{{ route('systemNotifications', $prefix) }}"
           style="color: {{ request()->is("{$prefix}/notifications/system") ? '#0E84E1' : '' }}">
            @if (!empty($systemNotificationCount))
                <span class="system-notification-count me-2">{{ $systemNotificationCount }}</span>
            @endif
            {{ explode(' ', __('names.systemNotifications'))[0] }}
        </a>
    </li>
    <li>
        <a class="dropdown-item d-flex align-items-center" href="{{ route('userNotifications', $prefix) }}"
           style="color: {{ request()->is("{$prefix}/notifications/user") ? '#0E84E1' : '' }}">
            @if (!empty($userNotificationCount))
                <span class="user-notification-count me-2">{{ $userNotificationCount }}</span>
            @endif
            {{ explode(' ', __('names.userNotifications'))[0] }}
        </a>
    </li>
</ul>
