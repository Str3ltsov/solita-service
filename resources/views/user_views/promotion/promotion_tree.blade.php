<ul class="promotion-tree nav nav-list flex-column">
    @foreach($promotions as $promotion)
        <li class="nav-item">
            <a href="{{ route("promotion", ["id" => $promotion->id] ) }}"
               class="nav-link {{ substr(url()->current(), -1) == "$promotion->id" ? 'active' : '' }}">
                <i class="fa-solid fa-angle-right"></i>
                {{ $promotion->name }}
                ({{ count($promotion->products) }})
            </a>
        </li>
    @endforeach
</ul>
