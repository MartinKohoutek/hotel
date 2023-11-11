@extends('frontend.main_master')
@section('main')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div id="carousel-home">
    <div class="owl-carousel owl-theme kenburns">
        @foreach ($carousel as $item)
        <div class="owl-slide background-image cover" data-background="url({{ asset($item->image) }})">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <div class="row justify-content-center justify-content-md-start">
                        <div class="col-lg-6 static">
                            <div class="slide-text white">
                                <small class="owl-slide-animated owl-slide-title">{{ $item->small_title }}</small>
                                <h2 class="owl-slide-animated owl-slide-title-2">{{ $item->title }}</h2>
                                <div class="owl-slide-animated owl-slide-title-3"><a class="btn_1 outline white mt-3" href="#first_section">Read more</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!--/owl-slide-->
        <!-- <div class="owl-slide background-image cover" data-background="url(img/restaurant/slides/slide_2.jpg)">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 static">
                            <div class="slide-text white text-center">
                                <small class="owl-slide-animated owl-slide-title">Restaurant Experience</small>
                                <h2 class="owl-slide-animated owl-slide-title-2">A truly taste experience</h2>
                                <div class="owl-slide-animated owl-slide-title-3"><a class="btn_1 outline white mt-3" href="#first_section">Read more</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!--/owl-slide-->
        <!-- <div class="owl-slide background-image cover" data-background="url(img/restaurant/slides/slide_3.jpg)">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center justify-content-md-end">
                        <div class="col-lg-6 static">
                            <div class="slide-text text-end white">
                                <small class="owl-slide-animated owl-slide-title">RestaurantExperience</small>
                                <h2 class="owl-slide-animated owl-slide-title-2">The experience of unique dishes</h2>
                                <div class="owl-slide-animated owl-slide-title-3"><a class="btn_1 outline white mt-3" href="#first_section">Read more</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--/owl-slide-->
        <!-- </div> -->
    </div>
    <div class="mouse_wp">
        <a href="#first_section" class="btn_scrollto">
            <div class="mouse"></div>
        </a>
    </div>
    <!-- / mouse -->
</div>
<!--/carousel-->

<div class="container margin_120_95">
    <div class="row justify-content-between align-items-center">
        <div class="col-lg-5">
            <div class="intro">
                <div class="title">
                    <small>{{ $info->title1 }}</small>
                    <h2>{{ $info->title2 }}</h2>
                </div>
                <p class="lead">{{ $info->short_description }}</p>
                <p>{{ $info->long_description }}</p>
                <p><em>{{ $info->footer }}</em></p>
            </div>
        </div>
        <div class="col-lg-5">
            <div>
                <ul class="list-unstyled mb-4">
                    <li class="d-flex justify-content-between mb-2 text-end">
                        <strong>Breakfast</strong> <span>{{ $info->breakfast_time }}</span>
                    </li>
                    <li class="d-flex justify-content-between mb-2 text-end">
                        <strong>Lunch</strong> <span>{{ $info->lunch_time }}</span>
                    </li>
                    <li class="d-flex justify-content-between mb-2 text-end">
                        <strong>Dinner</strong> <span>{{ $info->dinner_time }}</span>
                    </li>
                </ul>
                <p class="phone_element"><a href="tel:{{ $info->phone }}"><i class="bi bi-telephone"></i><span><em>Reservations</em>{{ $info->phone }}</span></a></p>
            </div>
        </div>
    </div>
    <!-- /Row -->
</div>
<!-- /container -->

<div class="pattern_3">
    <div class="container margin_120_95" id="first_section">
        <div class="title text-center mb-5">
            <small data-cue="slideInUp">Paradise Hotel</small>
            <h2 data-cue="slideInUp" data-delay="100">Restaruant Menu</h2>
        </div>
        <div class="tabs_menu" data-cue="slideInUp" data-delay="200">
            <ul class="nav nav-tabs" role="tablist">
                @foreach ($categories as $key => $category)
                <li class="nav-item">
                    <a id="tab-{{ $category->id }}" href="#pane-{{ $category->id }}" class="nav-link {{ $key == 0 ? 'active' : '' }}" data-bs-toggle="tab" role="tab">{{ $category->category_name }}</a>
                </li>
                @endforeach
            </ul>
            <div class="tab-content add_bottom_25" role="tablist">
                @foreach ($categories as $key => $category)
                <div id="pane-{{ $category->id }}" class="card tab-pane fade {{ $key == 0 ? 'show active' : '' }}" role="tabpanel" aria-labelledby="tab-{{ $category->id }}">
                    <div class="card-header" role="tab" id="heading-{{ $category->id }}">
                        <h5>
                            <a class="collapsed" data-bs-toggle="collapse" href="#collapse-{{ $category->id }}" aria-expanded="true" aria-controls="collapse-{{ $category->id }}">
                                {{ $category->category_name }}
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-{{ $category->id }}" class="collapse" role="tabpanel" aria-labelledby="heading-{{ $category->id }}">
                        <div class="card-body">
                            @php
                                $banner = App\Models\RestaurantBanner::where('category_id', $category->id)->first();
                            @endphp
                            <div class="banner background-image" data-background="url({{ url($banner->background) }})">
                                <div class="wrapper d-flex align-items-center justify-content-between opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                                    <div>
                                        <small>{{ $banner->offer }}</small>
                                        <h3>{{ $banner->title }}</h3>
                                        <p>{{ $banner->short_description }}</p>
                                        <p style="width: 80%;">{{ $banner->long_description }}</p>
                                    </div>
                                    <figure class="d-none d-lg-block"><img src="{{ url($banner->banner) }}" alt="" width="200" height="200"></figure>
                                </div>
                                <!-- /wrapper -->
                            </div>
                            <!-- /banner -->
                            <div class="row magnific-gallery add_top_30">
                                @php
                                    $menuItems = App\Models\MenuItem::where('category_id', $category->id)->get();
                                @endphp
                                @foreach ($menuItems as $menuItem)
                                <div class="col-lg-6">
                                    <div class="menu_item">
                                        <figure>
                                            <a href="{{ asset($menuItem->image) }}" title="{{ $menuItem->title }}" data-fslightbox="gallery_{{ $category->id }}" data-type="image">
                                                <img src="{{ asset($menuItem->image) }}" alt="">
                                            </a>
                                        </figure>
                                        <div class="menu_title">
                                            <h3>{{ $menuItem->title }}</h3><em>${{ $menuItem->price }}</em>
                                        </div>
                                        <p>{{ $menuItem->ingredients }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- /card-body -->
                    </div>
                </div>
                @endforeach
                <!-- /tab -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /tabs_menu-->
    </div>
    <!-- /container -->
</div>
<!-- /pattern -->
<script src="{{ asset('frontend/js/slider.js') }}" defer></script>
@endsection