<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/21/2017
 * Time: 10:23 PM
 */
?>
@extends('layouts.blog.app')
@section('css')
    <style>
        .my-contrain {
            position: relative;
        }

        .fix-bg {
            position: absolute;
            left: 0;
            top: -40px;
            width: 100%;
            height: 800px;
            overflow: hidden;
        }

        .fix-bg .img {
            position: absolute;
            left: -20px;
            height: 100%;
            top: 0;
            width: calc(100% + 40px);
            background-repeat: no-repeat;
            background-position: top center;
            background-size: 100% auto;
            -webkit-filter: blur(10px);
            -moz-filter: blur(10px);
            -o-filter: blur(10px);
            -ms-filter: blur(10px);
            filter: blur(10px);
        }

        .fix-bg .inside {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: -webkit-linear-gradient(top, rgba(246, 246, 246, 0) 0, #f6f6f6 100%);
            background: linear-gradient(to bottom, rgba(246, 246, 246, 0) 0, #f6f6f6 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80f6f6f6', endColorstr='#f6f6f6', GradientType=0);
        }
    </style>
@stop
@section('content')
    <!-- The Article -->
    <div class="artcl-main float-width">
        <div class="artcl-prev-nxt float-width">
            <div class="artcl-prev w50 blocky">
                @if(count($previousPost))
                    <a href="{!! route('blog.article.show', $previousPost->getRouteExist($previousPost)) !!}">
                        <i class="fa fa-angle-left"></i> PREV ARTICLE</a>
                    <p>{!! strip_tags(str_limit($previousPost->title,45)) !!}</p>
                @endif
            </div>
            <div class="artcl-nxt w50 blocky text-right">
                @if(count($nextPost))
                    <a href="{!! route('blog.article.show', $nextPost->getRouteExist($nextPost)) !!}">
                        NEXT ARTICLE <i class="fa fa-angle-right"></i>
                    </a>
                    <p>{!! strip_tags(str_limit($nextPost->title,45)) !!}</p>
                @endif
            </div>
        </div>
        <div class="artcl-body float-width">
            <h2>{!! $post->excerptTitle(300) !!}</h2>
            <h5>
                <span><i class="fa fa-user"></i>{!! $post->checkAuthor() !!}</span>
                <span><i class="fa fa-clock-o"></i>{!! humanize_date($post->posted_at) !!}</span>
                <span><i class="fa fa-comment-o"></i>{!! count($post->comments) !!} comments</span>
            </h5>
            <article class="float-width articl-data">
                @if($post->hasThumbnail())
                    <img alt="{!! $post->excerptTitle(60) !!}"
                         src="{!! asset(route('media.posts.path',[$post->id,'large_'.$post->thumbnail()->filename])) !!}"
                         class="img-responsive"/>
                @else
                    <img alt="" src="{!! asset('blog/img/samples/a1.jpg') !!}"/>
                @endif
                <div class="content">
                    {!! $post->description !!}
                </div>
                <p class="artcl-qt">
                    <i class="fa fa-quote-left"></i>
                    <span>
                        Proin porta arcu sollicitudin magna viverra commodo. In pellentesque turpis sapien, at tincidunt dolor fringilla nec. Maecenas sollicitudin metus eget
                        vestibulum luctus.
                    </span>
                </p>
            </article>
        </div>
    </div>
    <!-- The Article Social Media Share -->
    <div class="artcl-scl float-width">
        <div class="lefty artcl-tags">
            <h3>TAGS : </h3>
            <ul>
                <li><a href="#">famous, </a></li>
                <li><a href="#">artist, </a></li>
                <li><a href="#">dj, </a></li>
                <li><a href="#">hip hop, </a></li>
                <li><a href="#">rap</a></li>
            </ul>
        </div>
        <div class="righty artcl-shr">
            <ul>
                <li>
                    <div class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/"
                         data-width="100" data-type="button"></div>
                </li>
                <li>
                    <a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>
                </li>
                <li>
                    <a href="http://www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.flickr.com%2Fphotos%2Fkentbrew%2F6851755809%2F&amp;media=http%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&amp;description=Next%20stop%3A%20Pinterest"
                       data-pin-do="buttonPin" data-pin-config="none"><img alt=""
                                                                           src="../../assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png"/></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Article Author Bio -->
    <div class="author-bio float-width">
        <h3 class="float-width">john smithowsky</h3>
        <div class="author-info">
            <img alt="" src="{!! asset('blog/img/samples/a2.jpg') !!}"/>
            <p>
                Aliquam tristique vehicula nulla sit amet facilisis. Nulla ultrices vitae eros at semper. Donec sapien
                lacus, tincidunt sed sem quis, accumsan mollis eros. Aenean id enim dolor. Suspendisse potenti.
            </p>
            <ul>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-rss"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
            </ul>
        </div>
    </div>
    <!-- Article Comments Section -->
    <div class="artcl-comments float-width">
        <h3 class="sec-title">COMMENTS</h3>
        <div class="comments-section float-width">
            <div class="single-comment">
                <img alt="" class="blocky" src="{!! asset('blog/img/samples/t1.jpg') !!}"/>
                <div class="the-comment lefty">
                    <h4>
                        <span class="comntr-nm lefty">Eiad Ashraf </span>
                        <span class="cmnt-dt lefty"> at 14 July 2013</span>
                        <a class="righty" href="#"><span class="cmnt-reply">Reply</span></a>
                    </h4>
                    <p>Praesent nec risus non tellus scelerisque congue eu eu purus. Aliquam id porta lacus. Morbi
                        eleifend ultricies placerat. Nullam luctus lectus a risus congue scelerisque. In in fermentum
                        nunc.</p>
                </div>
            </div>
            <div class="cmnt-dvdr"></div>
            <div class="single-comment reply-1">
                <img alt="" class="blocky" src="{!! asset('blog/img/samples/t2.jpg') !!}"/>
                <div class="the-comment lefty">
                    <h4>
                        <span class="comntr-nm lefty">Soza </span>
                        <span class="cmnt-dt lefty"> at 14 July 2013</span>
                        <a class="righty" href="#"><span class="cmnt-reply">Reply</span></a>
                    </h4>
                    <p>Praesent nec risus non tellus scelerisque congue eu eu purus. Aliquam id porta lacus. Morbi
                        eleifend ultricies placerat. Nullam luctus lectus a risus congue scelerisque. In in fermentum
                        nunc.</p>
                </div>
            </div>
            <div class="cmnt-dvdr"></div>
            <div class="single-comment reply-1">
                <img alt="" class="blocky" src="{!! asset('blog/img/samples/t3.jpg') !!}"/>
                <div class="the-comment lefty">
                    <h4>
                        <span class="comntr-nm lefty">Zoom </span>
                        <span class="cmnt-dt lefty"> at 14 July 2013</span>
                        <a class="righty" href="#"><span class="cmnt-reply">Reply</span></a>
                    </h4>
                    <p>Praesent nec risus non tellus scelerisque congue eu eu purus. Aliquam id porta lacus. Morbi
                        eleifend ultricies placerat. Nullam luctus lectus a risus congue scelerisque. In in fermentum
                        nunc.</p>
                </div>
            </div>
            <div class="cmnt-dvdr"></div>
            <div class="single-comment reply-2">
                <img alt="" class="blocky" src="{!! asset('blog/img/samples/t4.jpg') !!}">
                <div class="the-comment lefty">
                    <h4>
                        <span class="comntr-nm lefty">Ali Dawood </span>
                        <span class="cmnt-dt lefty"> at 14 July 2013</span>
                        <a class="righty" href="#"><span class="cmnt-reply">Reply</span></a>
                    </h4>
                    <p>Praesent nec risus non tellus scelerisque congue eu eu purus. Aliquam id porta lacus. Morbi
                        eleifend ultricies placerat. Nullam luctus lectus a risus congue scelerisque. In in fermentum
                        nunc.</p>
                </div>
            </div>
            <div class="cmnt-dvdr"></div>
            <div class="single-comment">
                <img alt="" class="blocky" src="{!! asset('blog/img/samples/t5.jpg') !!}"/>
                <div class="the-comment lefty">
                    <h4>
                        <span class="comntr-nm lefty">Miri Drik </span>
                        <span class="cmnt-dt lefty"> at 14 July 2013</span>
                        <a class="righty" href="#"><span class="cmnt-reply">Reply</span></a>
                    </h4>
                    <p>Praesent nec risus non tellus scelerisque congue eu eu purus. Aliquam id porta lacus. Morbi
                        eleifend ultricies placerat. Nullam luctus lectus a risus congue scelerisque. In in fermentum
                        nunc.</p>
                </div>
            </div>
        </div>
        <div class="cmnt-reply-form float-width">
            <h3 class="sec-title">LEAVE A RESPONSE</h3>
            <form role="form">
                <div class="form-group">
                    <input type="name" class="form-control" id="exampleInputName" placeholder="Name or nickname">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <input type="website" class="form-control" id="exampleInputWebsite"
                           placeholder="Website (optional)">
                </div>
                <textarea class="form-control" rows="6" placeholder="Your comment"></textarea>
                <a class="cmnt-btn trans2" href="#">POST YOUR COMMENT</a>
            </form>
        </div>
    </div>
    <!-- related Articles  -->
    <div class="artcl-reltd float-width">
        <h3 class="sec-title">RELATED POSTS</h3>
        <div class="reltd-sngl">
            <img alt="" src="img/samples/e1.jpg">
            <div class="reltd-sngl-txt">
                <h3>After party of Blondi Concert will begin tomorrow </h3>
                <p><i class="fa fa-clock-o"></i>20 Jan 2014</p>
            </div>
        </div>
        <div class="reltd-sngl">
            <img alt="" src="img/samples/e2.jpg">
            <div class="reltd-sngl-txt">
                <h3>After party of Blondi Concert will begin tomorrow </h3>
                <p><i class="fa fa-clock-o"></i>20 Jan 2014</p>
            </div>
        </div>
        <div class="reltd-sngl">
            <img alt="" src="img/samples/e3.jpg">
            <div class="reltd-sngl-txt">
                <h3>After party of Blondi Concert will begin tomorrow </h3>
                <p><i class="fa fa-clock-o"></i>20 Jan 2014</p>
            </div>
        </div>
        <div class="reltd-sngl">
            <img alt="" src="img/samples/e4.jpg">
            <div class="reltd-sngl-txt">
                <h3>After party of Blondi Concert will begin tomorrow </h3>
                <p><i class="fa fa-clock-o"></i>20 Jan 2014</p>
            </div>
        </div>
    </div>


    <!-- Facebook share JS -->
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            let js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "../../connect.facebook.net/en_US/all.js#xfbml=1&appId=135708533180992";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Twitter share JS -->
    <script>!function (d, s, id) {
            let js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = p + '://platform.twitter.com/widgets.js';
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, 'script', 'twitter-wjs');
    </script>

    <!-- Pinterest share JS -->
    <script type="text/javascript" async src="../../assets.pinterest.com/js/pinit.js"></script>

@stop
