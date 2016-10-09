<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @yield('meta_content')
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{asset('blog-assets/css/main.css')}}">
</head>
<body>
<div class="wrap_above_footer">


<header class="header clearfix">
    <a href="" class="header__logo">
        <img src="{{asset('blog-assets/img/logo3.png')}}" class="img-responsive">
    </a>
    <a href="" class="header__icon-hamburger"><span></span><span></span><span></span></a>
    <ul class="header__menu animate">
     <li class="header__menu__item"><a href=""> cixxao</a></li>
     <li class="header__menu__item"><a href=""> cixxao</a></li>
     <li class="header__menu__item"><a href=""> cixxao</a></li>
    </ul>
</header>



@yield('before_content')


<div class="container main-content">
    @yield('content')
</div>

</div>
<footer class="footer">


     <ul class="footer__lists-page">
        <li class="footer__list-item"><a href=""> Page 1</a></li>
        <li class="footer__list-item"><a href=""> Page 2</a></li>
        <li class="footer__list-item"><a href=""> Page 3</a></li>
    </ul>

    <div class="footer__disclaimer">
        Company - Address - Number
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('blog-assets/js/all.js')}}"></script>
</body>

