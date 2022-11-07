<div>
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ Auth::user() ? url("/user/messenger") : url("/messenger") }}">
                {{ __('menu.messenger') ?? '' }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ $user->name }}
            </span>
        </div>
    </div>
    <section class="pt-2">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-4 mt-4 mt-md-5 mt-lg-0">
                    <div class="sidebar">
                        <div class="widget">
                            <div class="widget-title-container d-flex justify-content-between align-items-center mb-2">
                                <h6 class="widget-title m-0 text-uppercase">
                                    {{ __('names.messages') }}
                                </h6>
                                <a class="btn btn-primary messenger-users-contact" href="{{ route('livewire.messenger.add') }}">
                                    <i class="fa-solid fa-plus me-2"></i>
                                    {{ __('buttons.contact') }}
                                </a>
                            </div>
                            <div class="category-tree-widget-content">
                                @include('livewire.messenger.users')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    @include('livewire.messenger.room')
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        /*
         * Scroll to previous Y position after sending your message
         */
        const setCookie = (cName, cValue, expDays) => {
            let date = new Date();
            date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
            const expires = `expires=${date.toUTCString()}`;
            document.cookie = `${cName}=${cValue};${expires}; path=/`;
        }

        const messengerWindowHeightValue = document.cookie
            .split('; ')
            .find((row) => row.startsWith('messengerWindowHeight='))
            ?.split('=')[1];

        window.onload = () => window.scrollTo(0, messengerWindowHeightValue);
        window.onscroll = () => setCookie('messengerWindowHeight', window.scrollY, 30);
    </script>
@endpush
