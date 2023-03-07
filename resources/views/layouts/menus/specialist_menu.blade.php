<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('specialist/orders*') ? 'active' : '' }}" href="/specialist/orders">
        <i class="fa-solid fa-folder"></i>
        {{ __('menu.orders') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('specialist/messages*') ? 'active' : '' }}" href="/specialist/messages">
        <i class="fa-solid fa-comment"></i>
        {{ __('names.messages') }}
    </a>
</li>
