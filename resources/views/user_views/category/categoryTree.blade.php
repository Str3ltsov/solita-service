<ul class="category-tree nav nav-list flex-column">
    @foreach($treeCategories as $category)
        <li class="nav-item">
            <a href="{{ route("innercategories", ["category_id" => $category->id ]) }}"
               class="nav-link {{ substr(url()->current(), -1) == "$category->id" ? 'active' : '' }}
               {{ request()->is('user/rootcategories') || request()->is('rootcategories') ? 'fs-6 my-1' : '' }}">
                <i class="fa-solid fa-angle-right"></i>
                {{ $category->name }}
                ({{ count($category->products) }})
            </a>
            @if(count($category->innerCategories))
                @include('user_views.category.categoryTreeChildren', ['childs' => $category->innerCategories])
            @endif
        </li>
    @endforeach
</ul>

{{--@push('scripts')--}}
{{--    <script src="/js/treeview.js"></script>--}}
{{--@endpush--}}
