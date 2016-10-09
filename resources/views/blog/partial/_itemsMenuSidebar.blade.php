<li class="sidebar-category__list__item"><a href="{{ route('blog.showPostsInCategory', ['id' => $category['id']]) }}">{{$category['name']}}</a></li>

@if (count($category['children']) > 0)
    <ul>
        @foreach ($category['children'] as $category)
            @include('blog.partial._itemsMenuSidebar', $category)
        @endforeach

    </ul>
@endif


