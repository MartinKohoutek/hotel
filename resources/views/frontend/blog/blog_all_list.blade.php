@extends('frontend.main_master')
@section('main')
<div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ url('/frontend/img/blogcat.jpg') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one" style="margin: 0 0 30px 0;">Luxury Hotel Experience</small>
            <h1 class="slide-animated two" style="font-size: 2.1875rem">All Blog News</h1>
        </div>
    </div>
</div>
<!-- /Background Img Parallax -->

<div class="container margin_120_95">
    <div class="isotope-wrapper">
        <div class="row justify-content-center">
            @foreach ($posts as $post)
            <div class="item col-xl-4 col-lg-6">
                <a href="{{ url('/blog/details/'.$post->post_slug) }}" class="box_contents" data-cue="slideInUp">
                    <figure><img src="{{ asset($post->post_image) }}" alt="" class="img-fluid"><em>{{ $post->created_at->format('d.m.Y') }}</em></figure>
                    <div class="wrapper">
                        <small>{{ $post->blogCategory->category_name }}<span></span></small>
                        <h2>{{ $post->post_title }}</h2>
                        <p style="color: black;">{{ $post->short_description }}</p>
                        <em>Read more</em>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <!--/row -->
    </div>
    <!--/isotope-wrapper -->

    <div class="pagination__wrapper">
        {{ $posts->links('vendor.pagination.custom') }}
    </div>
    <!-- /pagination -->

</div>
<!--/container -->
@endsection