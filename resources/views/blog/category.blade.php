@extends('layouts/blog')

@section('meta_content')
    <title>{{ $category->seo->title_tag }}</title>
    <meta name="description" content="{{ $category->seo->description_tag }}">
    <meta name="author" content="">
@endsection




@section('content')
    <div class="row"> <!-- Start central container  -->
        <div class="col-xs-12 col-md-8">

            @forelse ($posts as $post)
                <section class="row-post col-xs-12">
                    <div class="row-post__image col-xs-12 col-md-6">
                        <img src='{{ asset($post->image_path.$post->photo_filename) }}' class="img-responsive"/>
                    </div>

                    <div class="row-post__content col-xs-12 col-md-6">
                        <h3 class="row-post__title">
                            <a href="/{{ $post->slug }}">{{ $post->title }}</a>
                        </h3>
                        <span class="row-post__author">by {{ $post->user->name }}</span>
                        <span class="row-post__date">Published at {{ $post->publish_date }}</span>
                        <div class="row-post__abstract">
                            {{ $post->abstract }}
                        </div>
                    </div>
                </section>
            @empty
                <section class="row-post col-xs-12">
                    <p>Sorry, no post founds</p>
                </section>
            @endforelse


        </div>


        @include('blog.sidebar-categories')

    </div> <!-- End central container  -->
@endsection