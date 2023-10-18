@extends('frontend.main_master')
@section('main')
<div class="hero full-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img kenburns" src="img/rooms/1.jpg" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center  text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <small class="slide-animated one">Luxury Hotel Experience</small>
                    <h1 class="slide-animated two">Sierra Double Room</h1>
                    <p class="slide-animated three">Exquisite furnishings for a cosy ambience</p>
                </div>
            </div>
        </div>
        <div class="mouse_wp slide-animated four">
            <a href="#first_section" class="btn_explore">
                <div class="mouse"></div>
            </a>
        </div>
        <!-- / mouse -->
    </div>
</div>
<!-- /Background Img Parallax -->

<div class="container margin_120_95" id="booking_section">
    <div class="row justify-content-between">
        <div class="col-xl-4">
            <div data-cue="slideInUp">
                <div class="title">
                    <small>Paradise Hotel</small>
                    <h2>Check Availability</h2>
                </div>
                <p>Mea nibh meis philosophia eu. Duis legimus efficiantur ea sea. Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. </p>
                <div class="phone_element no_borders"><a href="tel://423424234"><i class="bi bi-telephone"></i><span><em>Info and bookings</em>+41 934 121 1334</span></a></div>
            </div>
        </div>
        <div class="col-xl-7">
            <div data-cue="slideInUp">
                <div id="message-booking"></div>
                <form method="post" action="phpmailer/reserve_template_email.php" id="bookingform" autocomplete="off">
                    <div class="booking_wrapper">
                        <div class="col-12">
                            <input type="text" id="date_booking" name="date_booking">
                        </div>

                        {{ json_encode(session('book_date')) }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="custom_select">
                                    <select class="wide" name="rooms_booking" id="rooms_booking">
                                        <option value="">Select Room</option>
                                        <option value="Double Room">Double Room</option>
                                        <option value="Deluxe Room">Deluxe Room</option>
                                        <option value="Superior Room">Superior Room</option>
                                        <option value="Junior Suite">Junior Suite</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="qty-buttons mb-3 version_2">
                                            <input type="button" value="+" class="qtyplus" name="adults_booking">
                                            <input type="text" name="adults_booking" id="adults_booking" value="" class="qty form-control" placeholder="Adults">
                                            <input type="button" value="-" class="qtyminus" name="adults_booking">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3 qty-buttons mb-3 version_2">
                                            <input type="button" value="+" class="qtyplus" name="childs_booking">
                                            <input type="text" name="childs_booking" id="childs_booking" value="" class="qty form-control" placeholder="Childs">
                                            <input type="button" value="-" class="qtyminus" name="childs_booking">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / row -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" name="name_booking" id="name_booking" class="form-control" placeholder="Name and Last Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="email" name="email_booking" id="email_booking" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <!-- / row -->
                        <hr>
                        <div class="pb-4">
                            <div class="row align-items-center justify-content-end">
                                <div class="col-auto">
                                    <label for="verify_booking" class="col-form-label"><strong>Are you human?</strong></label>
                                </div>
                                <div class="col-md-2 col-4">
                                    <input type="text" name="verify_booking" id="verify_booking" class="form-control" placeholder="3 + 1 = ?">
                                </div>
                            </div>
                        </div>
                        <!-- / row -->
                    </div>
                    <!-- / booking_wrapper -->
                    <p class="text-end mt-4"><input class="btn_1 outline" type="submit" value="Check Now" id="submit-booking"></p>
                </form>
            </div>
            <!-- /data cue -->
        </div>
        <!-- /col -->
    </div>
    <!-- /row -->
</div>
<!-- /container -->
@endsection