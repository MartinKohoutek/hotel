@php
    $about = \App\Models\BookArea::find(1);
@endphp

<div class="container margin_120_95" id="first_section">
    <div class="row justify-content-between flex-lg-row-reverse align-items-center">
        <div class="col-lg-5">
            <div class="parallax_wrapper">
                <img src="{{ asset($about->big_image) }}" alt="" class="img-fluid rounded-img">
                <div data-cue="slideInUp" class="img_over"><span data-jarallax-element="-30"><img src="{{ asset($about->small_image) }}" alt="" class="rounded-img"></span></div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="intro">
                <div class="title">
                    <small>{{ $about->short_title }}</small>
                    <h2>{{ $about->main_title }}</h2>
                </div>
                <p class="lead">{{ $about->short_description }}</p>
                <p>{{ $about->long_description }}</p>
                <p><em>{{ $about->author }}</em></p>
            </div>
        </div>
    </div>
    <!-- /Row -->
</div>