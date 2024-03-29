<header class="header w-100">
    <div class="header-body box-shadow-none border-top-0">
        <div class="header-top header-top-small-minheight">
            <div class="container">
                <div class="header-row justify-content-between">
                    <div class="header-column col-auto px-0">
                        <div class="header-row">
                            <a href="mailto:info@solita.lt" class="mb-0 d-none d-md-block">
                                <i class="fa-solid fa-envelope me-1"></i>
                                info@solita.lt
                            </a>
                            <span class="mx-3 d-md-block d-none"></span>
                            <a href="tel:+37037247749" class="mb-0 d-block">
                                <i class="fa-solid fa-phone me-1"></i>
                                +370(37)247749
                            </a>
                            <span class="mx-3 d-md-block d-none"></span>
                            <a href="https://www.google.com/maps/place/Taikos+pr.+88A,+51182+Kaunas/data=!4m2!3m1!1s0x46e71844c01926cf:0xa2937b6d3b4e5c5?sa=X&ved=2ahUKEwiwxrfr6M79AhUBgosKHcMdDSYQ8gF6BAgREAI"
                               class="mb-0 d-none d-md-block" target="_blank">
                                <i class="fa-solid fa-location-dot me-1"></i>
                                Taikos pr. 88a, 51182 Kaunas
                            </a>
                        </div>
                    </div>
                    <div class="header-column justify-content-end col-auto px-0">
                        <div class="header-row">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills text-2">
                                    <li class="nav-item dropdown nav-item-border">
                                        <a class="nav-link text-uppercase"
                                           href="#" role="button" id="dropdownLanguage" data-bs-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            {{ app()->getLocale() }}
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        @include('layouts.dropdowns.language_dropdown')
                                    </li>
                                </ul>
                                <span class="mx-2"></span>
                                <ul class="header-social-icons social-icons social-icons-clean social-icons-icon-gray">
                                    <li class="social-icons-facebook">
                                        <a href="{{ route('facebook.login') }}" target="_blank" title="Facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="social-icons-google">
                                        <a href="{{ route('google.login') }}" target="_blank" title="Google">
                                            <i class="fa-brands fa-google"></i>
                                        </a>
                                    </li>
                                    <li class="social-icons-twitter">
                                        <a href="{{ route('twitter.login') }}" target="_blank" title="Twitter">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-container container">
            <div class="header-row py-3">
                <div class="header-column w-100">
                    <div class="header-row justify-content-between">
                        <div class="header-logo z-index-2 col-lg-2 px-0" style="width: auto; height: auto">
                            <a href="{{ url('/products') }}">
                                <img src="{{ asset("images/logo.png") }}" alt="Solita" class="logo" width="160">
                            </a>
                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <div
                                class="header-nav header-nav-line header-nav-top-line header-nav-top-line-with-border justify-content-start" style="margin-left: 0;">
                                <div
                                    class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-3 header-nav-main-sub-effect-1 w-100">
                                    <nav class="collapse w-100" id="nav">
                                        <ul class="nav nav-pills w-100" id="mainNav">
                                            @guest
                                                @include('layouts.menus.menu')
                                            @else
                                                @include('layouts.menus.user_menu')
                                            @endguest
                                                <li class="nav-list pt-1">
                                                    <a class="{{ request()->is('eu_projects') ? 'active' : '' }}"
                                                       href="{{ url('/eu_projects') }}">
                                                        @if (app()->getLocale() == 'lt')
                                                            <img src="{{ asset('images/es_projektai.jpeg') }}" alt="es_projektai" width="85">
                                                        @else
                                                            <img src="{{ asset('images/eu_projects.jpeg') }}" alt="eu_projects" width="95" style="border: 10px solid white">
                                                        @endif
                                                    </a>
                                                </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="d-flex justify-content-end w-100">
                                    <button class="btn header-btn-collapse-nav hamburger-button" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav" aria-expanded="true">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex col-auto pe-0 ps-0 ps-xl-3">
                                <div class="header-nav-features ps-0 ms-0">
                                    <div class="header-nav-feature d-inline-flex top-2 ms-2">
                                        @guest
                                            <a href="{{ route('login') }}" role="button"
                                               class="login-button btn px-4 py-2 fw-bold">
                                                {{ __('buttons.login') }}
                                            </a>
                                        @else
                                            <a href="#" class="header-nav-features-toggle" role="button"
                                               id="navbarUserDropdown"
                                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ asset('images/icons/icon-account.png') }}" height="29" alt="icon-account" class="header-nav-features-img">
                                                <span class="d-none d-sm-inline-block" style="font-size: .58em">
                                                    {{ __('names.client') }}:
                                                    {{ Auth::user()->name }}
                                                </span>
                                            </a>
                                            @include('layouts.dropdowns.user_dropdown')
                                            <a href="#" class="notification-count-link mt-1 ms-2" role="button"
                                               id="navbarNotificationDropdown"
                                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-regular fa-bell" style="font-size: 1.7rem;"></i>
                                                @if (!empty($totalNotificationCount))
                                                    <span class="notification-count">{{ $totalNotificationCount }}</span>
                                                @endif
                                            </a>
                                            @include('layouts.dropdowns.notification_dropdown')
{{--                                            <a href="{{ url("/{$prefix}/viewcart") }}" class="header-nav-features-toggle">--}}
{{--                                                <img src="{{ asset('images/icons/icon-cart-big.svg') }}" height="28" alt="icon-cart-big" class="header-nav-features-img">--}}
{{--                                                @if (!empty($cartItemCount))--}}
{{--                                                    <span class="shopping-cart-items">{{ $cartItemCount }}</span>--}}
{{--                                                @endif--}}
{{--                                            </a>--}}
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    .notification-count-link > .notification-count {
        position: absolute;
        top: -1px;
        left: 14px;
    }

    .notification-count-link > .notification-count,
    .system-notification-count,
    .user-notification-count {
        width: 16px;
        height: 16px;
        background-color: #f33535;
        border-radius: 10px;
        color: #fff;
        font-size: .7em;
        font-weight: 500;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

@push('scripts')
    <script>
        const nav = document.getElementById('nav');
        const maxWidth = 991;

        window.innerWidth > maxWidth && nav.classList.add('show');

        window.addEventListener(
            'resize',
            event => window.innerWidth > maxWidth ? nav.classList.add('show') : nav.classList.remove('show'),
            true
        );

        const header = document.querySelector('.header');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 0) header.style.position = 'relative'
            if (window.scrollY > topbarHeight) header.style.position = 'sticky';
        });

        document.onscroll = () => onStickyNavbar();

        const onStickyNavbar = () => {
            if (document.body.scrollTop > topbarHeight || document.documentElement.scrollTop > topbarHeight)
                header.style.top = '-42px';
            else
                header.style.top = '0';
        }
    </script>
@endpush
