@extends('layouts/blog')




@section('content')
    <div class="row"> <!-- Start central container  -->
        <div class="col-xs-12 col-md-8">

            <section class="main-post">
                <div class="main-post__image">
                    <img src='{{ asset($post->image_path.$post->photo_filename) }}' class="img-responsive"/>
                </div>


                <h3 class="main-post__title">

                    <a href="{{ $post->slug}}">
                        {!! Purifier::clean($post->title) !!}
                    </a>

                </h3>
                <span class="main-post__author">by {{ $post->user->name }}</span>
                <span class="main-post__date"> Published on {{ $post->publish_date }}</span>
                <div class="main-post__abstract">
                {!! Purifier::clean($post->content) !!}
</div>
</section>

</div>


@include('blog.sidebar-categories')

</div> <!-- End central container  -->
@endsection