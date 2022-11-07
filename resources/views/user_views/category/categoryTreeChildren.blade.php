<ul>
    @foreach($childs as $child)
        <li class="nav-item">
            <a href="{{ route("innercategories", ["category_id" => $child->id ])}}"
               class="nav-link {{ str_contains(url()->current(), "/innercategories/$child->id") ? 'active' : '' }}
               {{ request()->is('user/rootcategories') || request()->is('rootcategories') ? 'fs-6 my-1' : '' }}">
                <i class="fa-solid fa-angle-right"></i>
                {{ $child->name }}
                ({{ count($child->products) }})
            </a>
            @if(count($child->innerCategories))
                @include('user_views.category.categoryTreeChildren', ['childs' => $child->innerCategories])
            @endif
        </li>
    @endforeach
</ul>
