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
                {{ __('names.contactUsers') }}
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
                                <h6 class="widget-title m-0">
                                    {{ __('names.messages') }}
                                </h6>
                            </div>
                            <div class="category-tree-widget-content">
                                @include('livewire.messenger.users')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-5">
                    <div class="messenger-add-users p-4 mb-4 mb-sm-5">
                        <h6 class="messenger-add-users-title m-0">
                            {{ __('names.contactUsers') }}
                        </h6>
                        @include('livewire.messenger.add_users')
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
