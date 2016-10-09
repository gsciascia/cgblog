<aside class="sidebar-content col-md-4">
    <div class="sidebar-category">
        <h4 class="sidebar-category__title">Categories</h4>
        <ul class="sidebar-category__list">
        @each('blog.partial._itemsMenuSidebar', $categories, 'category')
        </ul>
        {{--
        <ul class="sidebar-category__list">

            @foreach ($categories as $category)
            <li class="sidebar-category__list__item">
                <a href="{{ route('blog.showPostsInCategory', ['id' => $category['id']]) }}">{{$category['name']}}</a>
                @if($category['children'])
                    <ul>
                        @foreach ($category['children'] as $category)
                            <li class="sidebar-category__list__item">
                                <a href="{{ route('blog.showPostsInCategory', ['id' => $category['id']]) }}">{{$category['name']}}</a>
                            </li>
                        @endforeach

                    </ul>
                    @endif
            </li>
            @endforeach

        </ul>
--}}
    </div>

</aside>