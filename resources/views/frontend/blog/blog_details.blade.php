@extends('frontend.main_master')
@section('main')
<style>
    .services-bar-widget {
        margin-bottom: 35px;
        background-color: #fff;
    }

    .services-bar-widget .title {
        font-size: 20px;
        color: #292323;
        padding: 30px 30px 0;
        font-weight: 700;
    }

    .services-bar-widget .side-bar-categories {
        padding: 10px 30px 20px;
    }

    .services-bar-widget .side-bar-categories ul {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }

    .services-bar-widget .side-bar-categories ul li {
        position: relative;
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: 600;
        /* background-color: #FEF7F6; */
        background-color: #FEF7F6;
        border: 1px solid #978667;
    }

    .services-bar-widget .side-bar-categories ul li:hover {
        background-color: #978667;
    }

    .services-bar-widget .side-bar-categories ul li a {
        display: inline-block;
        color: #1B2132;
        font-weight: normal;
        padding: 8px 20px;
        font-weight: 600;
    }

    .services-bar-widget .side-bar-categories ul li a:hover {
        color: #ffffff;
    }

    .side-bar-widget .widget-popular-post {
        background-color: #fff;
        border-radius: 10px;
        position: relative;
        overflow: hidden;
        padding: 20px;
    }

    .side-bar-widget .widget-popular-post .item {
        overflow: hidden;
        margin-bottom: 20px;
        padding-bottom: 10px;
    }

    .side-bar-widget .widget-popular-post .item:last-child {
        margin-bottom: 0;
        border-bottom: none;
        padding-bottom: 0;
    }

    .side-bar-widget .widget-popular-post .item .thumb {
        float: left;
        overflow: hidden;
        position: relative;
        margin-right: 15px;
    }

    .side-bar-widget .widget-popular-post .item .thumb .full-image {
        width: 80px;
        height: 80px;
        display: inline-block;
        background-size: cover !important;
        background-repeat: no-repeat;
        background-position: center center !important;
        position: relative;
        background-color: #555555;
    }

    .side-bar-widget .widget-popular-post .item .info {
        overflow: hidden;
    }

    .side-bar-widget .widget-popular-post .item .info .title-text {
        margin-bottom: 5px;
        line-height: 1.5;
        font-size: 17px;
        font-weight: 700;
        max-width: 215px;
    }

    .side-bar-widget .widget-popular-post .item .info .title-text a {
        display: inline-block;
        color: #555555;
        margin-bottom: 20px;
    }

    .side-bar-widget .widget-popular-post .item .info .title-text a:hover {
        color: #EE786C;
    }

    .side-bar-widget .widget-popular-post .item .info ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .side-bar-widget .widget-popular-post .item .info ul li {
        display: inline-block;
        margin-right: 15px;
        color: #555555;
    }

    .side-bar-widget .widget-popular-post .item .info ul li:last-child {
        margin-right: 0;
    }
</style>
<div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset($post->post_image) }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one" style="margin: 0 0 30px 0;">{{ $post->created_at->format('d.m Y') }} - by {{ $post->blogAuthor->name }}</small>
            <h1 class="slide-animated two" style="font-size: 2.1875rem">{{ $post->post_title }}</h1>
        </div>
    </div>
</div>
<!-- /Background Img Parallax -->

<div class="container margin_120_95">
    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-5 order-lg-2">
            <div class="services-bar-widget">
                <h3 class="title">Categories</h3>
                <div class="side-bar-categories">
                    <ul>
                        @foreach ($categories as $category)
                        <li>
                            @php
                            $count = \App\Models\BlogPost::where('blog_category_id', $category->id)->count();
                            @endphp
                            <a href="{{ url('/blog/category/list/'.$category->id) }}">{{ $category->category_name }} <span class="badge bg-secondary position-absolute end-0" style="margin-right: 10px;">{{ $count }}</span></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="side-bar-widget">
                <div class="widget-popular-post">
                    <h3 class="title mb-4 text-center" style="font-size: 20px; font-weight: 700">Recent Posts</h3>
                    @foreach ($recent_posts as $item)
                    <article class="item">
                        <a href="{{ url('/blog/details/'.$item->post_slug) }}" class="thumb">
                            <img src="{{ asset($item->post_image) }}" alt="" style="width: 80px; height: 80px">
                        </a>
                        <div class="info">
                            <h4 class="title-text">
                                <a href="{{ url('/blog/details/'.$item->post_slug) }}" style="margin-bottom: 0;">
                                    {{ $item->post_title }}
                                </a>
                            </h4>
                            <ul>
                                <li>
                                    <i class='bx bx-time'></i>
                                    {{ $item->created_at->format('d.m Y') }}
                                </li>
                                <!-- <li>
                                    <i class='bx bx-message-square-detail'></i>
                                    15K
                                </li> -->
                            </ul>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7 order-lg-1">
            <div class="box_contents_in">
                <h2 class="mb-4">{{ $post->post_title }}</h2>
                <p>{{ $post->short_description }}</p>
            </div>

            <figure><img src="{{ asset($post->post_image) }}" alt="" class="img-fluid" style="width: 800px; height: 500px;"></figure>

            <div class="box_contents_in">
                <p>{!! $post->long_description !!}</p>
            </div>
        </div>
    </div>
    <!--/row -->
</div>
<!--/container -->

<div class="bg_white">
    <div class="container margin_120_95">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div id="comments">
                    @php
                    $comments = \App\Models\BlogComment::where('post_id', $post->id)->where('status', '1')->limit(5)->get();
                    @endphp
                    <h3>Comments</h3>
                    <ul>
                        @foreach ($comments as $comment)
                        <li>
                            <div class="avatar">
                                <a href="#"><img src="{{ (!empty($comment->user->photo)) ? url('upload/user_images/'.$comment->user->photo) : url('upload/no_image.jpg') }}" alt="">
                                </a>
                            </div>
                            <div class="comment_right clearfix">
                                <div class="comment_info">
                                    By <a href="#">{{ $comment->user->name }}</a><span>|</span>{{ $comment->created_at->format('d.m.Y') }}
                                </div>
                                <p>
                                    {!! $comment->message !!}
                                </p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @if (count($comments) > 0)
                <hr class="more_margin">
                @else
                <p>No comments yet!</p>
                @endif
                <h5 class="mb-3">Leave a comment</h5>

                @php
                if (Auth::check()) {
                $id = Auth::user()->id;
                $userData = \App\Models\User::find($id);
                } else {
                $userData = null;
                }
                @endphp

                @auth
                <form action="{{ route('store.blog.comment') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    @if ($userData)
                    <input type="hidden" name="user_id" value="{{ $userData->id }}">
                    @endif
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="comments2" rows="6" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit2" class="btn_1 outline mb-3">Submit</button>
                    </div>
                </form>
                @else
                <p>Please <a href="{{ route('login') }}">login</a> first to Add Comment</p>
                @endauth
            </div>
        </div>
    </div>
    <!--/container -->
</div>
<!--/bg_white -->
@endsection