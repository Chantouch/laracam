<!DOCTYPE html>
{{--<html lang="{{ app()->getLocale() }}">--}}
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="{{ app()->getLocale() }}">
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="{{ app()->getLocale() }}">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="{{ app()->getLocale() }}">
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ app()->getLocale() }}">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ MetaTag::get('title') }} | {{ config('app.name', 'Laravel') }}</title>
    {!! MetaTag::tag('description') !!}
    {!! MetaTag::tag('image') !!}
    {!! MetaTag::openGraph() !!}
    {!! MetaTag::twitterCard() !!}
    <!--Set default share picture after custom section pictures--!>
    {!! MetaTag::tag('image', asset('images/default-logo.png')) !!}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('blog/css/css8b0d.css?file=bootstrap.min') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/css97f7.css?file=bootstrap-theme') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/css4610.css?file=normalize') !!}">
    <link rel="stylesheet" href="{!! asset('blog/fonts/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/csse1a8.css?file=elements') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/css35ad.css?file=main') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/css9a38.css?file=responsive') !!}">
    <link rel="stylesheet" href="{!! asset('blog/css/cssf83a.css?file=calendar') !!}">
    <script src="{!! asset('blog/js/jsde43.css?file=vendor/modernizr-2.6.2-respond-1.1.0.min') !!}"></script>
    @yield('css')
</head>
<body>
<div id="app">
    <!-- Main Home Layout start -->
    <!-- Top toolbar -->
    <div class="top-tool-bar">
        @include('layouts.blog.top-toolbar')
    </div>
    <!-- Logo and Ad banner -->
    <div class="logo-top-ad">
        @include('layouts.blog.logo-ads')
    </div>
    <!-- Main Menu -->
    <div class="main-menu">
        @include('layouts.blog.menu')
    </div>
    <!-- Home Slider and Big news blocks -->
    <div class="container">
        @yield('main-news-block')
    </div>
    <!-- News Ticker -->
    @if(!Request::is('article/*'))
        <div class="container">
            @include('layouts.blog.breaking-news')
        </div>
    @endif

    <div class="container-position">
        <div class="fix-bg">
            <div class="img" style="background-image:url('http://media.sabay.com/media/sabay-news/Social-International/General/man.jpg');"></div>
            <div class="inside"></div>
        </div>
        <!-- Main Body -->
        <div class="container">
            <!-- Main Left side -->
            <div class="main-left-side">
                @yield('content')
            </div>
            <!-- Main Right side -->
            <div class="main-right-side">
                @include('layouts.blog.main-right-side')
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="main-footers">
        <div class="container">
            @include('layouts.blog.footer')
        </div>
    </div>
    <!-- Copy right footer -->
    <div class="copy-rt-ftr">
        <div class="container">
            <a class="lefty">&#169; Copyright 2017, All Rights Reserved</a>
            <a href="#" class="righty">Design and development by: Chantouch SEK</a>
        </div>
    </div>
    <!-- Main Home Layout Ends -->
</div>

<!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}"></script>--}}

<script src="{!! asset('blog/js/jquery-3.2.1.min.js') !!}"></script>
{{--<script src="{!! asset('blog/js/js5a10.js?file=vendor/jquery-3.2.1.min') !!}"></script>--}}

<script src="{!! asset('bootstrap/dist/js/bootstrap.min.js') !!}"></script>

<script src="{!! asset('blog/js/jsec26.css?file=jquery.smartmenus.min') !!}"></script>

<script src="{!! asset('blog/js/js047d.css?file=jquery.flexslider-min') !!}"></script>

<script src="{!! asset('blog/js/js288f.css?file=newsTicker') !!}"></script>

<script src="{!! asset('blog/js/js6a7f.css?file=jquery.customSelect.min') !!}"></script>

<script src="{!! asset('blog/js/jse3a4.css?file=retina-1.1.0.min') !!}"></script>

<script src="{!! asset('blog/js/jsf0b3.css?file=jflickrfeed.min') !!}"></script>

<script src="{!! asset('blog/js/jsf83a.css?file=calendar') !!}"></script>

<script src="{!! asset('blog/js/js35ad.js?file=main') !!}"></script>

<script src="{!! asset('blog/js/slick.min.js') !!}"></script>

@yield('plugins')

@yield('scripts')

</body>
</html>