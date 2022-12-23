<li class="nav-list pb-0 pb-lg-1">
    <div class="d-flex justify-content-between align-items-center mt-2 pe-2">
        <a href="{{ url("/products") }}" class="dropdown-hover">
            {{ __('menu.products') }}
        </a>
        <i class="fas fa-chevron-down dropdown-hover-icon ms-1"></i>
    </div>
    <ul class="dropdown-menu dropdown-products">
        <li>
            <a class="dropdown-item {{ request()->is("products*") ? 'active' : '' }}"
               href="{{ url("/products") }}">
                {{ __('menu.products') }}
            </a>
        </li>
        <li>
            <a class="dropdown-item {{ request()->is("/employee/product_panel*") ? 'active' : '' }}"
               href="{{ url('/employee/product_panel') }}">
                {{ __('menu.productPanel') }}
            </a>
        </li>
    </ul>
</li>
<li class="nav-list">
    <a class="{{ request()->is("rootcategories*") ? 'active' : '' }}" href="{{ url("/rootcategories") }}">
        {{ __('menu.categories') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("promotions*") ? 'active' : '' }}" href="{{ url("/promotions") }}">
        {{ __('menu.promotions') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("{$prefix}/discountCoupons*") ? 'active' : '' }}" href="{{ url("/{$prefix}/discountCoupons") }}">
        {{ __('menu.discountCoupons') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("{$prefix}/messenger*") ? 'active' : '' }}" href="{{ url("/{$prefix}/messenger") }}">
        {{ __('menu.messenger') }}
    </a>
</li>
<li class="nav-list">
    <a class="{{ request()->is("{$prefix}/specialists*") ? 'active' : '' }}" href="{{ url("/{$prefix}/specialists") }}">
        {{ __('names.specialists') }}
    </a>
</li>
@if (Auth::user()->type == 2)
    <li class="nav-list">
        <a class="{{ request()->is('specialist/orders*') ? 'active' : '' }}" href="{{ url('/specialist/orders') }}">
            {{ __('menu.orders') }}
        </a>
    </li>
@elseif (Auth::user()->type == 3)
    <li class="nav-list">
        <a class="{{ request()->is('employee/orders*') ? 'active' : '' }}" href="{{ url('/employee/orders') }}">
            {{ __('menu.orders') }}
        </a>
    </li>
@endif
@if (Auth::user()->type == 2)
    <li class="nav-list">
        <a class="{{ request()->is('specialist/returns*') ? 'active' : '' }}" href="{{ url('/specialist/returns') }}">
            {{ __('menu.returns') }}
        </a>
    </li>
@elseif (Auth::user()->type == 3)
    <li class="nav-list">
        <a class="{{ request()->is('employee/returns*') ? 'active' : '' }}" href="{{ url('/employee/returns') }}">
            {{ __('menu.returns') }}
        </a>
    </li>
@endif

<style>
    .dropdown-hover-icon {
        font-size: 10px;
    }

    .dropdown-products {
        border-radius: 0;
        border: none;
        box-shadow: 0 10px 30px 10px rgb(0 0 0 / 5%)
    }

    .dropdown-item {
        font-size: .95em;
    }

    .dropdown-item.active, .dropdown-item:active {
        background: white;
        color: #FFA600FF;
    }

    @media (max-width: 991px) {
        .dropdown-hover-icon {
            font-size: 13px;
        }

        .dropdown-products.show {
            display: block;
            margin-left: 20px;
        }

        .dropdown-products {
            background: transparent;
            padding: 0;
            margin: 0;
            font-size: 10px;
            box-shadow: none;
            border-radius: 0;
            border: 0;
            clear: both;
            display: none;
            float: none;
            position: static;
        }

        .dropdown-products li {
            border-bottom: 1px solid #e8e8e8;
            clear: both;
            display: block;
            float: none;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .dropdown-products li a {
            font-size: 10px;
            font-style: normal;
            line-height: 20px;
            padding: 7px 8px;
            margin: 1px 0;
            border-radius: 4px;
            text-align: left;
        }
    }
</style>

<script>
    const dropdownLink = document.querySelector('.dropdown-hover');
    const dropdownProducts = document.querySelector('.dropdown-products');
    const dropdownHoverIcon = document.querySelector('.dropdown-hover-icon');

    const addShowHandler = () => dropdownProducts.classList.add('show');
    const removeShowHandler = () => dropdownProducts.classList.remove('show');
    const toggleShowHandler = () => dropdownProducts.classList.toggle('show');

    const showDropdownProducts = () => {
        dropdownLink.addEventListener('mouseover', addShowHandler);
        dropdownLink.addEventListener('mouseout', removeShowHandler);
        dropdownProducts.addEventListener('mouseover', addShowHandler);
        dropdownProducts.addEventListener('mouseout', removeShowHandler);
    }

    const removeDropdownProductsEvents = () => {
        dropdownLink.removeEventListener('mouseover', addShowHandler);
        dropdownLink.removeEventListener('mouseout', removeShowHandler);
    }

    const windowWidthEvent = () => {
        if (window.innerWidth > 991) {
            showDropdownProducts();
        }
        else {
            removeDropdownProductsEvents();
        }
    }

    const addDropdownProductsWithIcon = () => dropdownHoverIcon.addEventListener('click', toggleShowHandler);

    addDropdownProductsWithIcon();
    windowWidthEvent();

    window.addEventListener('resize', event => windowWidthEvent(), true);
</script>
