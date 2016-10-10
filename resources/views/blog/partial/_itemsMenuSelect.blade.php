<option value="{{ route('blog.showPostsInCategory', ['id' => $category['id']]) }}">
        {{$category['name']}}
</option>

@if (count($category['children']) > 0)
        @foreach ($category['children'] as $category)
            @include('blog.partial._itemsMenuSelect', $category)
        @endforeach
@endif


