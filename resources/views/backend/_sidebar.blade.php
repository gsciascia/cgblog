<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">


            @can('create', \App\Category::Class)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text-o"></i> <span>Categories</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('categories.create')}}"><i class="fa fa-circle-o"></i> New category</a></li>
                    <li><a href="{{route('categories.index')}}"><i class="fa fa-circle-o"></i> View all</a></li>
                </ul>
            </li>
           @endcan


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text-o"></i> <span>Posts</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('posts.create')}}"><i class="fa fa-circle-o"></i> New post</a></li>
                    <li><a href="{{route('posts.index')}}"><i class="fa fa-circle-o"></i> View all</a></li>
                    <li><a href="{{route('posts.trash')}}"><i class="fa fa-recycle"></i> Trash</a></li>

                </ul>
            </li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>