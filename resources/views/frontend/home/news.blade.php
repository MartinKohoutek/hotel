@php
    $posts = \App\Models\BlogPost::latest()->limit(3)->get();
@endphp
<div class="bg_white">
    <div class="container margin_120_95">
        <div class="title mb-3">
            <small data-cue="slideInUp">Luxury experience</small>
            <h2 data-cue="slideInUp" data-delay="200">News & Events</h2>
        </div>
        <div class="row justify-content-center home">
            @foreach ($posts as $post)
            <div class="item col-xl-4 col-lg-6">
                <a href="news-post.html" class="box_contents" data-cue="slideInUp" data-delay="300">
                    <figure><img src="{{ asset($post->post_image) }}" alt="" class="img-fluid"><em>{{ $post->created_at->format('d.m Y') }}</em></figure>
                    <div class="wrapper">
                        <small>{{ $post->blogCategory->category_name }}<span></span></small>
                        <h2>{{ $post->post_title }}</h2>
                        <p style="color: black">{{ $post->short_description }}</p>
                        <em>Read more</em>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <!--/row -->
        <p class="text-end"><a href="news-1.html" class="btn_1 outline mt-2" data-cue="slideInUp" data-delay="600">View all News</a></p>
    </div>
    <!--/container -->
</div>