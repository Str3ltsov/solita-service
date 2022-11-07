<div>
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.messenger') ?? '' }}
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
                <div class="col-lg-8 mb-5">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="text-muted">{{__('messages.openChat')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
