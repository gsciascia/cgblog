@extends('layouts/blog')



@section('content')
    <div class="row"> <!-- Start central container  -->
        <div class="col-xs-12 col-md-8">

            <section class="row-post col-xs-12">
                <div class="row-post__image col-xs-12 col-md-6">
                    <img src='https://source.unsplash.com/category/buildings/750x350' class="img-responsive"/>
                </div>

                <div class="row-post__content col-xs-12 col-md-6">
                    <h3 class="row-post__title">My main post</h3>
                    <span class="row-post__author">G. Sciascia</span>
                    <span class="row-post__date">14/06/1984</span>
                    <div class="row-post__abstract">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Ut eget elit suscipit, scelerisque ipsum id, posuere lectus. </div>
                </div>
            </section>

            <section class="row-post col-xs-12">
                <div class="row-post__image col-xs-12 col-md-6">
                    <img src='https://source.unsplash.com/category/buildings/750x350' class="img-responsive"/>
                </div>

                <div class="row-post__content col-xs-12 col-md-6">
                    <h3>My main post</h3>
                    <span class="row-post__author">G. Sciascia</span>
                    <span class="row-post__date">14/06/1984</span>
                    <div class="row-post__abstract">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Ut eget elit suscipit, scelerisque ipsum id, posuere lectus. </div>
                </div>
            </section>

        </div>

        <aside class="sidebar-content col-md-4">
            <div class="sidebar-category">
                <h4 class="sidebar-category__title">Categories</h4>

                <ul class="sidebar-category__list">
                    <li class="sidebar-category__list__item"><a href="#">Category 1</a></li>
                    <li class="sidebar-category__list__item"><a href="#">Category 1</a></li>
                    <li class="sidebar-category__list__item"><a href="#">Category 1</a></li>

                </ul>

            </div>

        </aside>

    </div> <!-- End central container  -->
@endsection