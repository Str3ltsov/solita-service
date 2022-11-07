<li class="nav-item">
    <a href="{{ route('discountCoupons.index') }}"
       class="nav-link {{ Request::is('discountCoupons*') ? 'active' : '' }}">
        <p>Discount Coupons</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('promotions.index') }}"
       class="nav-link {{ Request::is('promotions*') ? 'active' : '' }}">
        <p>Promotions</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('products.index') }}"
       class="nav-link {{ Request::is('products*') ? 'active' : '' }}">
        <p>Products</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('customers.index') }}"
       class="nav-link {{ Request::is('customers*') ? 'active' : '' }}">
        <p>Customers</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('orderStatuses.index') }}"
       class="nav-link {{ Request::is('orderStatuses*') ? 'active' : '' }}">
        <p>Order Statuses</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cartStatuses.index') }}"
       class="nav-link {{ Request::is('cartStatuses*') ? 'active' : '' }}">
        <p>Cart Statuses</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('returnStatuses.index') }}"
       class="nav-link {{ Request::is('returnStatuses*') ? 'active' : '' }}">
        <p>Return Statuses</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('carts.index') }}"
       class="nav-link {{ Request::is('carts*') ? 'active' : '' }}">
        <p>Carts</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cartItems.index') }}"
       class="nav-link {{ Request::is('cartItems*') ? 'active' : '' }}">
        <p>Cart Items</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('orders.index') }}"
       class="nav-link {{ Request::is('orders*') ? 'active' : '' }}">
        <p>Orders</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('orderItems.index') }}"
       class="nav-link {{ Request::is('orderItems*') ? 'active' : '' }}">
        <p>Order Items</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('returns.index') }}"
       class="nav-link {{ Request::is('returns*') ? 'active' : '' }}">
        <p>Returns</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('returnItems.index') }}"
       class="nav-link {{ Request::is('returnItems*') ? 'active' : '' }}">
        <p>Return Items</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('messages.index') }}"
       class="nav-link {{ Request::is('messages*') ? 'active' : '' }}">
        <p>Messages</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('ratings.index') }}"
       class="nav-link {{ Request::is('ratings*') ? 'active' : '' }}">
        <p>Ratings</p>
    </a>
</li>


