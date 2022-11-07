<header class="admin-header">
    <div class="admin-header-container">
        <div class="admin-header-top-container">
            <a href="{{ url('/home') }}" class="admin-header-logo">
                <img src="{{ asset("images/aurintus_logo.png") }}" alt="logo" class="logo" width="160">
            </a>
            <button class="admin-header-toggle-button" onclick="onClickOpenMenu()">
                <i class="fa-sharp fa-solid fa-bars text-white"></i>
            </button>
        </div>
        <hr class="admin-header-hr">
        <div class="admin-header-center-container">
            <ul class="admin-navbar">
                @include('layouts.menus.admin_menu')
            </ul>
        </div>
        <hr class="admin-header-hr">
        <div class="admin-header-bottom-container">
            <a href="#" class="admin-header-account-dropdown" role="button"
               id="navbarUserDropdown"
               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('images/icons/icon-account.png') }}" height="25" alt="icon-account" class="admin-header-account-icon">
                <span class="admin-header-account-name">{{ Auth::user()->name }}</span>
            </a>
            @include('layouts.dropdowns.admin_dropdown')
            <ul class="nav nav-pills">
                <li class="nav-item dropdown nav-item-border">
                    <a class="nav-link text-uppercase admin-navbar-language-dropdown"
                       href="#" role="button" id="dropdownLanguage" data-bs-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        {{ app()->getLocale() }}
                        <i class="fas fa-angle-down"></i>
                    </a>
                    @include('layouts.dropdowns.language_dropdown')
                </li>
            </ul>
        </div>
    </div>
</header>

@push('scripts')
    <script>
        const maxWidth = 991;

        const adminHeaderContainer = document.querySelector('.admin-header-container');
        const adminHeaderCenter = document.querySelector('.admin-header-center-container');
        const adminHeaderBottom = document.querySelector('.admin-header-bottom-container');
        const hrs = document.querySelectorAll('.admin-header-hr');

        if (window.innerWidth < maxWidth) {
            adminHeaderContainer.classList.add('container');
            adminHeaderCenter.classList.add('hide');
            adminHeaderBottom.classList.add('hide');
            hrs.forEach(hr => hr.classList.add('hide'))
        }

        window.addEventListener(
            'resize',
            event => {
                if (window.innerWidth < maxWidth) {
                    adminHeaderContainer.classList.add('container');
                    adminHeaderCenter.classList.add('hide');
                    adminHeaderBottom.classList.add('hide');
                    hrs.forEach(hr => hr.classList.add('hide'))
                } else {
                    adminHeaderContainer.classList.remove('container');
                    adminHeaderCenter.classList.remove('hide');
                    adminHeaderBottom.classList.remove('hide');
                    hrs.forEach(hr => hr.classList.remove('hide'))
                }
            },
            true
        );

        const onClickOpenMenu = () => {
            adminHeaderCenter.classList.toggle('hide');
            adminHeaderBottom.classList.toggle('hide');
            hrs.forEach(hr => hr.classList.toggle('hide'))
        }
    </script>
@endpush
