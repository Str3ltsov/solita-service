<footer class="footer">
    <div class="container pb-4">
        <div class="row py-4 my-5">
            <div class="col-md-6 @auth col-lg-3 @else col-lg-4 @endauth mb-5 mb-lg-0">
                <a href="{{ url('/home') }}">
                    <img src="{{ asset("images/aurintus_logo.png") }}" alt="logo" class="logo_footer" width="180">
                </a>
                <div class="d-flex mt-4 mb-4 mb-md-0">
                    <div class="me-3">
                        <i class="fa-regular fa-clock fs-5"></i>
                    </div>
                    <div class="w-100 d-flex flex-column">
                        <span>{{ __('footer.timeDesc') }}:</span>
                        <span>{{ __('footer.timeOne') }}: 10:00 - 18:00</span>
                        <span>{{ __('footer.timeTwo') }}: 10:00 - 17:00</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 @auth col-lg-3 @else col-lg-4 @endauth mb-5 mb-lg-0 ps-1 @auth ps-3 @else ps-5 @endauth">
                <h5 class="mb-4">{{ __('footer.contactUs') }}</h5>
                <ul class="list list-unstyled pt-3">
                    <li class="pb-4">
                        <i class="fa-solid fa-location-dot fs-5 me-3"></i>
                        Karaliaučiaus g. 3-17, LT-06281 Vilnius
                    </li>
                    <li class="pb-4">
                        <i class="fa-solid fa-phone fs-5 me-3"></i>
                        +370 689 96899
                    </li>
                    <li class="pb-4">
                        <i class="fa-regular fa-envelope fs-5 me-3"></i>
                        uabaurintus@gmail.com
                    </li>
                    <li class="pb-4">
                        <i class="fa-solid fa-clipboard fs-5 me-3"></i>
                         304873930
                    </li>
                </ul>
                <ul class="social-icons social-icons-clean-with-border social-icons-medium">
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
            </div>
            <div class="col-md-6 @auth col-lg-3 @else col-lg-4 @endauth mb-5 mb-lg-0 ps-1 @auth ps-3 @else ps-5 @endauth">
                <h5 class="mb-4 pb-2">{{ __('footer.menu') }}</h5>
                <ul class="list list-unstyled mb-0 footer-links">
                    <li class="nav-list">
                        <a class="{{ request()->is('products*') ? 'active' : '' }}" href="{{ url('/products') }}">
                            <i class="fa-solid fa-angle-right me-2"></i>
                            {{ __('menu.products') }}
                        </a>
                    </li>
                    <li class="nav-list">
                        <a class="{{ request()->is('rootcategories*') ? 'active' : '' }}" href="{{ url('/rootcategories') }}">
                            <i class="fa-solid fa-angle-right me-2"></i>
                            {{ __('menu.categories') }}
                        </a>
                    </li>
                    <li class="nav-list">
                        <a class="{{ request()->is('promotions*') ? 'active' : '' }}" href="{{ url('/promotions') }}">
                            <i class="fa-solid fa-angle-right me-2"></i>
                            {{ __('menu.promotions') }}
                        </a>
                    </li>
                    <li class="nav-list">
                        <a class="{{ request()->is('user/discountCoupons*') ? 'active' : '' }}" href="{{ url('/user/discountCoupons') }}">
                            <i class="fa-solid fa-angle-right me-2"></i>
                            {{ __('menu.discountCoupons') }}
                        </a>
                    </li>
                    <li class="nav-list">
                        <a class="{{ request()->is('user/messenger*') ? 'active' : '' }}" href="{{ url('/user/messenger') }}">
                            <i class="fa-solid fa-angle-right me-2"></i>
                            {{ __('menu.messenger') }}
                        </a>
                    </li>
                    <li class="nav-list">
                        <a class="{{ request()->is('user/termsofservice*') ? 'active' : '' }}" href="{{ url('/termsofservice') }}">
                            <i class="fa-solid fa-angle-right me-2"></i>
                            {{ __('menu.termsofservice') }}
                        </a>
                    </li>
                    <li class="nav-list">
                        <a class="{{ request()->is('user/policy*') ? 'active' : '' }}" href="{{ url('/policy') }}">
                            <i class="fa-solid fa-angle-right me-2"></i>
                            {{ __('menu.policy') }}
                        </a>
                    </li>
                    <li class="nav-list">
                        <a class="{{ request()->is('user/about*') ? 'active' : '' }}" href="{{ url('/about') }}">
                            <i class="fa-solid fa-angle-right me-2"></i>
                            {{ __('menu.about') }}
                        </a>
                    </li>
                </ul>
            </div>
            @auth
                <div class="col-md-6 @auth col-lg-3 @else col-lg-4 @endauth mb-5 mb-lg-0 ps-1 @auth ps-3 @else ps-5 @endauth">
                    <h5 class="mb-4 pb-2">{{ __('footer.profile') }}</h5>
                    <ul class="list list-unstyled mb-0 footer-links">
                        <li class="mb-0">
                            <a href="{{ url('/user/viewcart') }}">
                                <i class="fa-solid fa-angle-right me-2"></i>
                                {{__('menu.cart')}}
                            </a>
                        </li>
                        <li class="mb-0">
                            <a href="{{ url('/user/rootorders') }}">
                                <i class="fa-solid fa-angle-right me-2"></i>
                                {{__('menu.orders')}}
                            </a>
                        </li>
                        <li class="mb-0">
                            <a href="{{ url('/user/rootoreturns') }}">
                                <i class="fa-solid fa-angle-right me-2"></i>
                                {{__('menu.returns')}}
                            </a>
                        </li>
                        <li class="mb-0">
                            <a href="{{ url('/user/userprofile') }}">
                                <i class="fa-solid fa-angle-right me-2"></i>
                                {{__('menu.profile')}}
                            </a>
                        </li>
                        <li class="mb-0">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-angle-right me-2"></i>
                                    {{ __('menu.logout') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="footer-copyright py-4">
                <div class="row align-items-center justify-content-md-between">
                    <div class="col-12 col-md-auto text-center text-md-start">
                        <p class="mb-0">{{ __('footer.copyright') }}</p>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="d-flex justify-content-center justify-content-md-end">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
