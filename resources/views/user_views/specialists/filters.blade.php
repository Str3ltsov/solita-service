<aside class="sidebar">
    <form method="get" action="{{ route("specialists", $prefix) }}" id="mainForm">
        <h5 class="sidebar-title pt-2">{{ __('names.filterByRating') }}</h5>
        <div class="filter-by-price-widget-content">
            <fieldset class="form-group">
                <div id="range-slider" class="slider mb-3 mt-1 mx-1" wire:ignore></div>
                <div class="filter-by-price-button-container mb-3">
                    <div class="d-flex">
                        <span>{{ __('names.rating')}} (<i class="fa-solid fa-star text-warning"></i>):</span>
                        <input type="text" id="filter[rating_from]" name="filter[rating_from]"
                               readonly
                               value="{{ $filter["rating_from"] ?? '0' }}"
                               class="border-0 text-end filter-by-price-number"
                               style="max-width: 40px"/>
                        <span class="text-center"> — </span>
                        <input type="text" id="filter[rating_to]" name="filter[rating_to]" readonly
                               value="{{ $filter["rating_to"] ?? '0' }}"
                               class="border-0 text-start filter-by-price-number"
                               style="max-width: 40px"/>
                    </div>
                </div>
            </fieldset>
        </div>
        <h5 class="sidebar-title">{{ __('names.skills') }}</h5>
        <ul class="nav nav-list flex-column">
            @forelse($skills as $skill)
                <div class="nav-link">
                    <label class="form-check-label" style="cursor: pointer">
                        <input class="form-check-input me-2" type="checkbox" value="{{ $skill->id }}"
                               id="skill" onclick="setSkills();" name="filter[skills_users.skill_id]" style="cursor: pointer"
                                @if ($filter && array_key_exists('skills_users.skill_id', $filter))
                                    {{ in_array($skill->id, $selectedSkills) ? "checked=\"checked\""  : ""}}
                                @endif
                        >
                        {{ $skill->name }}
                    </label>
                </div>
            @empty
                <div class="nav-link">
                    <span class="text-muted">{{ __('names.noSkills') }}</span>
                </div>
            @endforelse
            <input type="text" value="{{ implode(",", $selectedSkills) }}"
                   name="filter[skills_users.skill_id]" id="filter[skills_users.skill_id]" class="d-block">
            <input type="hidden" id="order" name="order" value="{{ $selectedOrder }}">
        </ul>
        <div class="d-flex flex-column align-items-center w-100 gap-1">
            <button type="submit" class="btn btn-primary product-filter-button">
                <i class="fa-solid fa-filter me-2 my-2"></i>
                {{ __('buttons.filter') }}
            </button>
            <a href="{{ route('specialists', $prefix) }}" class="orders-returns-secondary-button w-100 py-2">
                <i class="fa-solid fa-spray-can-sparkles me-2 my-2"></i>
                {{ __('reports.clear') }}
            </a>
        </div>
    </form>
</aside>
