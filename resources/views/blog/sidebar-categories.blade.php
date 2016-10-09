<aside class="sidebar-content col-md-4">
    <div class="sidebar-category">
        <h4 class="sidebar-category__title">Categories</h4>
        <ul class="sidebar-category__list">
        @each('blog.partial._itemsMenuSidebar', $categories, 'category')
        </ul>
    </div>
</aside>