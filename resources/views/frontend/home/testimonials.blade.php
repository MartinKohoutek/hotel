<div class="parallax_section_1 jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img kenburns-2" src="{{ asset('frontend/img/hero_home_1.jpg') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="title white">
                        <small class="mb-1">Testimonials</small>
                        <h2>What Clients Says</h2>
                    </div>
                    <div class="carousel_testimonials owl-carousel owl-theme nav-dots-orizontal">
                        @php
                        $testimonials = \App\Models\Testimonial::latest()->get();
                        @endphp

                        @foreach ($testimonials as $testimonial)
                        <div>
                            <div class="box_overlay">
                                <div class="pic">
                                    <figure><img src="{{ asset($testimonial->image) }}" alt="" class="img-circle">
                                    </figure>
                                    <h4>{{ $testimonial->name }}<small>{{ $testimonial->city }}</small></h4>
                                </div>
                                <div class="comment">
                                    {!! $testimonial->message !!}
                                </div>
                            </div>
                            <!-- End box_overlay -->
                        </div>
                        @endforeach
                        </div>
                    </div>
                    <!-- End carousel_testimonials -->
                </div>
            </div>
        </div>
    </div>
</div>