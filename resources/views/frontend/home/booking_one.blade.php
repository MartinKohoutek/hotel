<div class="hero home-search full-height jarallax" data-jarallax-video="mp4:{{ asset('frontend/video/sunset.mp4') }},webm:{{ asset('frontend/video/sunset.webm') }},ogv:{{ asset('frontend/video/sunset.ogv') }}" data-speed="0.2">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Luxury Hotel Experience</small>
            <h3 class="slide-animated two">A unique Experience<br>where to stay</h3>
            <div class="row justify-content-center slide-animated three">
                <div class="col-xl-10">
                    <div class="row g-0 booking_form">
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <input class="form-control" type="text" name="dates" id="dates" placeholder="Check in / Check out" readonly="readonly">
                                <i class="bi bi-calendar2"></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 pe-lg-0 pe-sm-1">
                            <div class="qty-buttons">
                                <label>Adults</label>
                                <input type="button" value="+" class="qtyplus" name="adults">
                                <input type="text" name="adults" id="adults" value="" class="qty form-control">
                                <input type="button" value="-" class="qtyminus" name="adults">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 ps-lg-0 ps-sm-1">
                            <div class="qty-buttons">
                                <label>Childs</label>
                                <input type="button" value="+" class="qtyplus" name="childs">
                                <input type="text" name="childs" id="childs" value="" class="qty form-control">
                                <input type="button" value="-" class="qtyminus" name="childs">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="submit" class="btn_search" value="Search">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mouse_wp slide-animated four">
            <a href="#first_section" class="btn_scrollto">
                <div class="mouse"></div>
            </a>
        </div>
        <!-- /mouse_wp -->
    </div>
</div>