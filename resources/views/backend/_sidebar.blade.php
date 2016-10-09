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


                @can('create', \App\User::Class)
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i> <span>Users</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('users.create')}}"><i class="fa fa-circle-o"></i> New users</a>
                            </li>
                            <li><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i> View all</a></li>
                        </ul>
                    </li>
                @endcan

                <li class="treeview">
                    <a href="{{ route('user.profile') }}" >
                        <i class="fa fa-key"></i> <span>Your profile</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>


                <li class="treeview">
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form-sidebar').submit();" >
                        <i class="fa fa-sign-out"></i> <span>Logout</span>
                        <span class="pull-right-container"></span>
                    </a>

                    <form id="logout-form-sidebar" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>