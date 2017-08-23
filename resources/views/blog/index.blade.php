<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/21/2017
 * Time: 10:23 PM
 */
?>
@extends('layouts.blog.app')

@section('main-news-block')
    <div class="main-news-blks">
        <div class="hm-slider-cont">
            <!-- News slider -->
            <div class="flex-container">
                <div class="flexslider hm-slider">
                    <ul class="slides">
                        <li>
                            <img alt="" src="blog/img/samples/sample.jpg"/>
                            <h3 class="cat-label cat-label1"><a href="#">NEWS</a></h3>
                            <div class="hm-sldr-caption">
                                <h3><a href="#">Rugby Players are shocked about new rules in game<span
                                                class="topic-icn">17</span></a></h3>
                                <p>Curabitur fringilla porttitor porta. Vivamus vel nulla ullamcorper,
                                    fringilla ligula nec, pellentesque nisl. Sed dolor justo, dapibus quis tellus
                                    et,
                                    rhoncus rhoncus purus...
                                </p>
                            </div>
                        </li>
                        <li>
                            <img alt="" src="blog/img/samples/sample6.jpg"/>
                            <h3 class="cat-label cat-label1"><a href="#">NEWS</a></h3>
                            <div class="hm-sldr-caption">
                                <h3><a href="#">Abu Trika Strikes a new Goal!<span class="topic-icn">17</span></a>
                                </h3>
                                <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as
                                    their
                                    default model text, and a search for 'lorem ipsum' will uncover many web sites
                                    still
                                    in their infancy. Various versions have evolved over...
                                </p>
                            </div>
                        </li>
                        <li>
                            <img alt="" src="blog/img/samples/sample7.jpg"/>
                            <h3 class="cat-label cat-label1"><a href="#">NEWS</a></h3>
                            <div class="hm-sldr-caption">
                                <h3><a href="#">Kawerki is the new future in Tennis<span class="topic-icn">17</span></a>
                                </h3>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                    have
                                    suffered alteration in some form, by injected humour, or randomised words which
                                    don't look even slightly believable...
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Fixed Blocks -->
        <div class="mid-blks-cont">
            <!-- Block1 -->
            <div class="mid-block-1 boxgrid caption">
                <img alt="" src="blog/img/samples/sample1.jpg"/>
                <h4 class="cat-label cat-label2"><a href="#">GAMES</a></h4>
                <div class="cover boxcaption">
                    <h3><a href="#single.html">Need for Speed Rivals is still a growing community</a><span
                                class="topic-icn">81</span></h3>
                    <p>Curabitur fringilla porttitor porta. Vivamus vel nulla ullamcorper, fringilla ligula nec,
                        pellentesque nisl.</p>
                    <a href="#">MORE <i class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
            <!-- Block2 -->
            <div class="mid-block-2 boxgrid caption">
                <img alt="" src="blog/img/samples/sample3.jpg"/>
                <h4 class="cat-label cat-label3"><a href="#">TOURISM</a></h4>
                <div class="cover boxcaption">
                    <h3><a href="#single.html">20 best places to see weekly with your whole family</a><span
                                class="topic-icn">36</span></h3>
                    <p>Curabitur fringilla porttitor porta. Vivamus vel nulla ullamcorper, fringilla ligula nec,
                        pellentesque nisl.</p>
                    <a href="#">MORE <i class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>
        <!-- Block3 -->
        <div class="rt-bk-cont">
            <div class="rt-block boxgrid2 caption">
                <img alt="" src="blog/img/samples/sample2.jpg"/>
                <h4 class="cat-label cat-label4"><a href="#">MUSIC</a></h4>
                <div class="cover boxcaption2">
                    <h3><a href="#single.html">Diana Krall - Jazz female vocalist going for a big wedding</a><span
                                class="topic-icn">98</span></h3>
                    <p>Curabitur fringilla porttitor porta. Vivamus vel nulla ullamcorper, fringilla ligula nec,
                        pellentesque nisl.</p>
                    <a href="#">MORE <i class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')
    <!-- Top News Section -->
    <div class="top-news float-width">
        <div class="float-width sec-cont">
            <h3 class="sec-title">Top news</h3>
            <div class="top-big-two">
                @if(count($posts))
                    @foreach($posts->random(1) as $post)
                        <div class="big-two-1 blocky boxgrid3 caption">
                            <img alt="" src="blog/img/samples/sample4.jpg"/>
                            <div class="cover boxcaption3">
                                <h3><a href="#single.html">Red hair just coming back to fashion</a></h3>
                                <p class="artcl-time-1">
                                    <span><i class="fa fa-clock-o"></i>20 Jan 2014</span>
                                    <span><i class="fa fa-comment-o"></i>21 comments</span>
                                </p>
                                <p>Curabitur fringilla porttitor porta. Vivamus vel nulla ullamcorper, fringilla ligula
                                    nec,
                                    pellentesque nisl. Sed dol...</p>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if(count($posts))
                    @foreach($posts->random(1) as $post)
                        <div class="big-two-2 blocky boxgrid3 caption">
                            <img alt="" src="blog/img/samples/sample5.jpg"/>
                            <div class="cover boxcaption3">
                                <h3><a href="#single.html">Arrows will be allowed in Olympic Sport</a></h3>
                                <p class="artcl-time-1">
                                    <span><i class="fa fa-clock-o"></i>20 Jan 2014</span>
                                    <span><i class="fa fa-comment-o"></i>13 comments</span>
                                </p>
                                <p>Curabitur fringilla porttitor porta. Vivamus vel nulla ullamcorper, fringilla ligula
                                    nec,
                                    pellentesque nisl. Sed dol...</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @if(isset($categories))
            @if(count($categories))
                @foreach($categories as $category)
                    @foreach($category->articles->random(1) as $article)
                        <div class="tn-small-1 blocky">
                            <a href="#">
                                <img alt="{!! $article->title !!}" class="lefty"
                                     src="{!! asset($article->path.$article->images->file) !!}"/>
                            </a>
                            <h4 class="lefty">{!! $article->title !!}</h4>
                            <a class="lefty cat-a cat-label{!! $category->id !!}" href="#">{!! $category->name !!}</a>
                            <p class="righty">
                                <span>
                                    <i class="fa fa-clock-o"></i> {!! $article->created_at->diffForHumans() !!}
                                </span>
                            </p>
                        </div>
                    @endforeach
                @endforeach
            @endif
        @endif
    </div>
    {{--<!-- Sec 1 -->--}}
    @if(isset($categories))
        @if(count($categories))
            @foreach($categories as $category)
                <div class="news-sec-1 float-width">
                    <div class="float-width sec-cont2">
                        <h3 class="sec-title"><a href="#">{!! $category->name !!}</a></h3>
                        <div class="sec-1-big float-width">
                            <img alt="" class="blocky" src="blog/img/samples/z1.jpg"/>
                            <div class="sec-1-big-text lefty">
                                <h3>Famous artist share his tracks for free</h3>
                                <h6><span><i class="fa fa-user"></i>John Doe</span><span><i
                                                class="fa fa-clock-o"></i>20 Jan 2014</span><span><i
                                                class="fa fa-comment-o"></i>21 comments</span></h6>
                                <p>Suspendisse dapibus blandit auctor. Aenean nisl felis, fermentum in ante sit amet,
                                    lobortis
                                    hendrerit nunc. Curabitur pharetra in velit at ornare. Pellentesque vitae nibh
                                    volutpat
                                    velit feugiat euismod ut a elit. Donec in felis rutrum risus bibendum cursus.
                                    Aliquam
                                    interdum aliquam elementum ...</p>
                            </div>
                        </div>
                        <div class="sec-1-sm">
                            <img alt="" class="blocky" src="blog/img/samples/e5.jpg"/>
                            <div class="sec-1-sm-text blocky">
                                <h3>TOP 10 Pop track list past year</h3>
                                <h6><span><i class="fa fa-clock-o"></i>20 Jan 2014</span><span><i
                                                class="fa fa-comment-o"></i>21 comments</span>
                                </h6>
                                <p>Suspendisse dapibus blandit auctor. Aenean nisl felis, fermentum in ante sit...</p>
                            </div>
                        </div>
                        <div class="sec-1-sm">
                            <img alt="" class="blocky" src="blog/img/samples/e6.jpg"/>
                            <div class="sec-1-sm-text blocky">
                                <h3>Another Hip-Hop rising star</h3>
                                <h6><span><i class="fa fa-clock-o"></i>20 Jan 2014</span><span><i
                                                class="fa fa-comment-o"></i>21 comments</span>
                                </h6>
                                <p>Suspendisse dapibus blandit auctor. Aenean nisl felis, fermentum in ante sit...</p>
                            </div>
                        </div>
                        <div class="sec-1-sm">
                            <img alt="" class="blocky" src="blog/img/samples/e7.jpg"/>
                            <div class="sec-1-sm-text blocky">
                                <h3>New MP3 tracks are coming </h3>
                                <h6><span><i class="fa fa-clock-o"></i>20 Jan 2014</span><span><i
                                                class="fa fa-comment-o"></i>21 comments</span>
                                </h6>
                                <p>Suspendisse dapibus blandit auctor. Aenean nisl felis, fermentum in ante sit...</p>
                            </div>
                        </div>
                        <div class="sec-1-sm">
                            <img alt="" class="blocky" src="blog/img/samples/e8.jpg"/>
                            <div class="sec-1-sm-text blocky">
                                <h3>DJ Open Music Festival 2014</h3>
                                <h6><span><i class="fa fa-clock-o"></i>20 Jan 2014</span><span><i
                                                class="fa fa-comment-o"></i>21 comments</span>
                                </h6>
                                <p>Suspendisse dapibus blandit auctor. Aenean nisl felis, fermentum in ante sit...</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endif
    {{--<!-- News slider -->--}}
    <div class="qk-slider float-width">
        <h3 class="sldr-title">slider</h3>
        <div class="flexslider news-sldr">
            <ul class="slides">
                @if(isset($posts))
                    @if(count($posts))
                        @foreach($posts as $post)
                            <li>
                                <div class="trans2 slide-sngl">
                                    <a class="text-center" href="#">
                                        <img alt="" src="{!! asset('blog/img/samples/s1.jpg') !!}"/>
                                    </a>
                                    <h4><a href="#">Listen during running</a></h4>
                                    <p>
                                        Suspendisse dapibus blandit auctor. Aenean nisl felis, fermentum in ante sit ...
                                    </p>
                                    <h6>
                                        <span><i class="fa fa-clock-o"></i>{!! $post->created_at->format('d M Y') !!}</span>
                                    </h6>
                                </div>
                            </li>
                        @endforeach
                    @endif
                @endif
            </ul>
        </div>
    </div>
    <!-- POLLS AND REVIEWS -->
    <div class="news-sec-2 float-width">
        <div class="float-width sec-cont3">
            <h3 class="sec-title">TECHNOLOGY - POLLS AND REVIEWS</h3>
            <div class="polls-cont">
                <div class="polls-left blocky">
                    <a href="#"><img alt="" class="polls-bg-img" src="blog/img/samples/z4.jpg"/></a>
                    <div class="pol-lft-txt">
                        <h4 class="float-width">Pizza will be delivered by Drons</h4>
                        <a href="#" class="lefty"><img alt="" src="blog/img/4-stars.png"/></a>
                        <h6 class="righty"><span><i class="fa fa-clock-o"></i>20 Jan 2014</span><span><i
                                        class="fa fa-comment-o"></i>21 comments</span></h6>
                        <p class="float-width">Suspendisse dapibus blandit auctor. Aenean nisl felis, fermentum
                            in
                            ante sit amet, lobortis hendrerit nunc. Curabitur pharetra in velit at ornare.
                            Pellentesque vitae nibh volutpat velit feugiat euismod ut a elit. Donec in felis
                            rutrum
                            risus bibendum cursus. Aliquam interdum aliquam elementum ...</p>
                    </div>
                </div>
                <div class="polls-right lefty">
                    <div class="pol-rt-sm float-width">
                        <a href="#" class="lefty pol-rt-img"><img alt="" src="blog/img/samples/m1.jpg"/></a>
                        <h5>Pizza will be delivered by Drons</h5>
                        <h6 class="lefty"><span><i class="fa fa-clock-o"></i>20 Jan 2014</span><span><i
                                        class="fa fa-comment-o"></i>21 comments</span></h6>
                        <a href="#" class="lefty stars"><img alt="" src="blog/img/4-stars.png"/></a>
                    </div>
                    <div class="pol-rt-sm float-width">
                        <a href="#" class="lefty pol-rt-img"><img alt="" src="blog/img/samples/m2.jpg"/></a>
                        <h5>YouTube as a real Television?</h5>
                        <h6 class="lefty"><span><i class="fa fa-clock-o"></i>20 Jan 2014</span><span><i
                                        class="fa fa-comment-o"></i>21 comments</span></h6>
                        <a href="#" class="lefty stars"><img alt="" src="blog/img/4-stars.png"/></a>
                    </div>
                    <div class="pol-rt-sm float-width">
                        <a href="#" class="lefty pol-rt-img"><img alt="" src="blog/img/samples/m3.jpg"/></a>
                        <h5>Flying Mouse to your PC</h5>
                        <h6 class="lefty"><span><i class="fa fa-clock-o"></i>20 Jan 2014</span><span><i
                                        class="fa fa-comment-o"></i>21 comments</span></h6>
                        <a href="#" class="lefty stars"><img alt="" src="blog/img/4-stars.png"/></a>
                    </div>
                    <div class="pol-rt-sm float-width">
                        <a href="#" class="lefty pol-rt-img"><img alt="" src="blog/img/samples/m4.jpg"/></a>
                        <h5>Best gadget ever on your hand</h5>
                        <h6 class="lefty"><span><i class="fa fa-clock-o"></i>20 Jan 2014</span><span><i
                                        class="fa fa-comment-o"></i>21 comments</span></h6>
                        <a href="#" class="lefty stars"><img alt="" src="blog/img/4-stars.png"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Images news with slider -->
    <div class="sm-gal-cont float-width">
        <h3 class="sec-title">TOURISM - GALLERY</h3>
        <div class="sm-gal-bg">
            <a href="#"><img alt="" src="blog/img/samples/z5.jpg"/></a>
        </div>
        <div class="flexslider img-sm-gal righty">
            <ul class="slides">
                <li>
                    <img alt="" src="blog/img/samples/r1.jpg"/>
                    <img alt="" src="blog/img/samples/r5.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r2.jpg"/>
                    <img alt="" src="blog/img/samples/r6.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r3.jpg"/>
                    <img alt="" src="blog/img/samples/r7.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r4.jpg"/>
                    <img alt="" src="blog/img/samples/r8.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r1.jpg"/>
                    <img alt="" src="blog/img/samples/r5.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r2.jpg"/>
                    <img alt="" src="blog/img/samples/r6.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r3.jpg"/>
                    <img alt="" src="blog/img/samples/r7.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r4.jpg"/>
                    <img alt="" src="blog/img/samples/r8.jpg">
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r1.jpg"/>
                    <img alt="" src="blog/img/samples/r5.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r2.jpg"/>
                    <img alt="" src="blog/img/samples/r6.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r3.jpg"/>
                    <img alt="" src="blog/img/samples/r7.jpg">
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r4.jpg"/>
                    <img alt="" src="blog/img/samples/r8.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r1.jpg"/>
                    <img alt="" src="blog/img/samples/r5.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r2.jpg"/>
                    <img alt="" src="blog/img/samples/r6.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r3.jpg"/>
                    <img alt="" src="blog/img/samples/r7.jpg"/>
                </li>
                <li>
                    <img alt="" src="blog/img/samples/r4.jpg"/>
                    <img alt="" src="blog/img/samples/r8.jpg"/>
                </li>
            </ul>
        </div>
    </div>
    <!-- Videos Section -->
    <div class="vid-gal float-width">
        <h3 class="sec-title">TECHNOLOGY - VIDEOS</h3>
        <div class="vid-gal-bg float-width">
            <iframe src="http://player.vimeo.com/video/83714647" width="100%" height="387" frameborder="0"
                    webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
        <div class="vid-thmb">
            <ul class="float-width">
                <li><img alt="" src="blog/img/samples/b1.jpg"/></li>
                <li><img alt="" src="blog/img/samples/b2.jpg"/></li>
                <li><img alt="" src="blog/img/samples/b3.jpg"/></li>
                <li><img alt="" src="blog/img/samples/b4.jpg"/></li>
            </ul>
        </div>
    </div>
@stop

