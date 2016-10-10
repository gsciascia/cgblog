<li class="sidebar-category__list__item">
    <a href="{{ route('blog.showPostsInCategory', ['id' => $categories_hierarchical['id']]) }}">{{$categories_hierarchical['name']}}</a></li>

@if (count($categories_hierarchical['children']) > 0)
    <ul>
        @foreach ($categories_hierarchical['children'] as $categories_hierarchical)
            @include('blog.partial._itemsMenuSidebar', $categories_hierarchical)
        @endforeach

    </ul>
@endif