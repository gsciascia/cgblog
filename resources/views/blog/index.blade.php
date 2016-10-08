@extends('layouts/blog')

@section('before_content')
<section class="slide">
    <div class="slide__filter"></div>
    <div class="slide__text-box">
        <h1 class="slide__text-box--title">Lorem ipsm</h1>
        <h2 class="slide__text-box--subtitle">Lorem ipsm</h2>
    </div>
</section>
@endsection


@section('content')
    <div class="row"> <!-- Start central container  -->

        <div class="col-xs-12 col-md-8">

        @forelse ($posts as $post)


            @if ($loop->first)
            <section class="main-post">
                <div class="main-post__image">
                    <img src='https://source.unsplash.com/category/buildings/750x350' class="img-responsive"/>
                </div>

                <h3 class="main-post__title">{{ $post->title }}</h3>
                <span class="main-post__author">by {{ $post->user->name }}</span>
                <span class="main-post__date"> Published at {{ $post->publish_date }}</span>
                <div class="main-post__abstract">
                    {{ $post->abstract }}
                </div>
            </section>
            @else

            <section class="row-post col-xs-12">
                <div class="row-post__image col-xs-12 col-md-6">
                    <img src='https://source.unsplash.com/category/buildings/750x350' class="img-responsive"/>
                </div>

                <div class="row-post__content col-xs-12 col-md-6">
                    <h3 class="row-post__title">{{ $post->title }}</h3>
                    <span class="row-post__author">by {{ $post->user->name }}</span>
                    <span class="row-post__date">Published at {{ $post->publish_date }}</span>
                    <div class="row-post__abstract">
                        {{ $post->abstract }}
                    </div>
                </div>
            </section>

            @endif
            @empty
                <section class="row-post col-xs-12">
                <p>Sorry, no post founds</p>
                </section>
            @endforelse



        </div>






        <aside class="sidebar-content col-md-4">
            <div class="sidebar-category">
                <h4 class="sidebar-category__title">Categories</h4>

                <ul class="sidebar-category__list">
                    @foreach ($categories as $category)
                    <li class="sidebar-category__list__item"><a href="{{ route('blog.showPostsInCategory', ['id' => $category->id]) }}">{{$category->name}}</a></li>
                    @endforeach

                </ul>

            </div>

        </aside>

    </div> <!-- End central container  -->
@endsection