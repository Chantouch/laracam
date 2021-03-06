<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/26/2017
 * Time: 12:53 PM
 */
?>
@if(isset($categories))
    @if(count($categories))
        @foreach($categories as $category)
            <div class="news-sec-1 float-width">
                <div class="float-width sec-cont2">
                    <h3 class="sec-title">
                        <a href="{!! route('blog.topics.show',[$category->getRouteKey()]) !!}">
                            {!! $category->name !!}
                        </a>
                    </h3>
                    @if(count($category->articles))
                        @foreach($category->articles->random(1) as $post)
                            <div class="sec-1-big float-width">
                                @if($post->hasThumbnail())
                                    <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                        <img alt="{!! $post->title !!}" class="blocky"
                                             src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                                    </a>
                                @endif
                                <div class="sec-1-big-text lefty">
                                    <h3>
                                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                            {!! str_limit( $post->title, 45) !!}
                                        </a>
                                    </h3>
                                    <h6>
                                        <span>
                                            <i class="fa fa-user"></i>{!! $post->author->name !!}
                                        </span>
                                        <span>
                                            <i class="fa fa-clock-o"></i>{!! $post->posted_at->format('d M Y') !!}
                                        </span>
                                        <span>
                                            <i class="fa fa-comment-o"></i>21 comments
                                        </span>
                                    </h6>
                                    <p>
                                        {!! $post->excerpt(500) !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if(count($category->articles))
                        @foreach($category->articles->random(4) as $post)
                            <div class="sec-1-sm">
                                @if($post->hasThumbnail())
                                    <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                        <img alt="" class="blocky"
                                             src="{!! asset(route('media.posts.path',[$post->id,'small_'.$post->thumbnail()->filename])) !!}"/>
                                    </a>
                                @endif
                                <div class="sec-1-sm-text blocky">
                                    <h3>
                                        <a href="{!! route('blog.article.show', [$post->getRouteKey()]) !!}">
                                            {!!str_limit( $post->title, 25) !!}
                                        </a>
                                    </h3>
                                    <h6>
                                        <span>
                                            <i class="fa fa-clock-o"></i>{!! $post->posted_at->format('d M Y') !!}
                                        </span>
                                        <span>
                                            <i class="fa fa-comment-o"></i>21 comments
                                        </span>
                                    </h6>
                                    <p>{!! $post->excerpt(100) !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@endif
