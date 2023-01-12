<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('specialist/orders*') ? 'active' : '' }}" href="/specialist/orders">
        <i class="fa-solid fa-folder"></i>
        {{ __('menu.orders') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('specialist/messenger') ? 'active' : '' }}" href="/specialist/messenger">
        <i class="fa-solid fa-comment"></i>
        {{ __('menu.messenger') }}
    </a>
</li>
