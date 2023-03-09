<ul class="dropdown-menu" aria-labelledby="navbarNotificationDropdown" style="font-size: 1.1em">
    <li>
        <a class="dropdown-item d-flex align-items-center" href="{{ route('systemNotifications', $prefix) }}"
           style="color: {{ request()->is("{$prefix}/userprofile*") ? '#ffa600' : '' }}">
            @if (!empty($systemNotificationCount))
                <span class="system-notification-count me-2">{{ $systemNotificationCount }}</span>
            @endif
            {{__('names.systemNotifications')}}
        </a>
    </li>
    <li>
        <a class="dropdown-item d-flex align-items-center" href="{{ route('userNotifications', $prefix) }}"
           style="color: {{ request()->is("{$prefix}/userprofile*") ? '#ffa600' : '' }}">
            @if (!empty($userNotificationCount))
                <span class="user-notification-count me-2">{{ $userNotificationCount }}</span>
            @endif
            {{__('names.userNotifications')}}
        </a>
    </li>
</ul>
