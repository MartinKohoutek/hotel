@extends('frontend.main_master')
@section('main')
<div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="img/hero_home_2.jpg" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Luxury Hotel Experience</small>
            <h1 class="slide-animated two">Gallery</h1>
        </div>
    </div>
</div>
<!-- /Background Img Parallax -->

<div class="container margin_120_95">
    <div class="isotope-wrapper">
        <div class="row justify-content-center">
            @foreach ($gallery as $item)
            <div class="item col-xl-4 col-lg-6 col-mb-6 mb-4">
                <div class="item-img" data-cue="slideInUp">
                    <img src="{{ asset($item->photo) }}" alt="" />
                    <div class="content">
                        <a data-fslightbox="gallery_1" data-type="image" href="{{ url($item->photo) }}"><i class="bi bi-arrows-angle-expand"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--/row -->
    </div>
    <!--/isotope-wrapper -->

    <div class="pagination__wrapper">
       {{ $gallery->links('vendor.pagination.custom') }}
    </div>
    <!-- /pagination -->

</div>
<!--/container -->
@endsection