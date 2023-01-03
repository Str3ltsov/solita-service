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
    <a class="admin-navbar-link {{ request()->is('employee/returns*') ? 'active' : '' }}" href="{{ url('/employee/returns') }}">
        <i class="fa-solid fa-rotate-left"></i>
        {{ __('menu.returns') }}
    </a>
</li>
<li class="admin-navbar-item">
    <a class="admin-navbar-link {{ request()->is('employee/messenger') ? 'active' : '' }}" href="/employee/messenger">
        <i class="fa-solid fa-comment"></i>
        {{ __('menu.messenger') }}
    </a>
</li>
