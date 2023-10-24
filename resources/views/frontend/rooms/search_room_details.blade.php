@extends('frontend.main_master')
@section('main')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('frontend/js/daterangepicker.js') }}"></script>

<div class="hero full-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img kenburns" src="{{ asset('upload/roomimg/'.$room->image) }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center  text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <small class="slide-animated one">Luxury Hotel Experience</small>
                    <h1 class="slide-animated two">{{ $room->roomtype->name }}</h1>
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

<div class="bg_white" id="first_section">
    <div class="container margin_120_95">
        <div class="row justify-content-between">
            <div class="col-lg-4">
                <div class="title">
                    <small>Luxury Experience</small>
                    <h2>{{ $room->short_description }}</h2>
                </div>
                <p>{!! $room->description !!}</p>
            </div>
            <div class="col-lg-6">
                <div class="room_facilities_list">
                    <ul data-cues="slideInLeft">
                        @foreach ($facilities as $fac)
                        <li><i class="icon-hotel-double_bed_2"></i>{{ $fac->facility_name }}</li>
                        @endforeach
                        <li><i class="icon-hotel-safety_box"></i> Safety Box</li>
                        <li><i class="icon-hotel-patio"></i>Balcony</li>
                        <li><i class="icon-hotel-tv"></i> 32 Inch TV</li>
                        <li><i class="icon-hotel-disable"></i> Disable Access</li>
                        <li><i class="icon-hotel-dog"></i> Pet Allowed</li>
                        <li><i class="icon-hotel-bottle"></i> Welcome Bottle</li>
                        <li><i class="icon-hotel-wifi"></i> Wifi / Netflix access</li>
                        <li><i class="icon-hotel-hairdryer"></i> Air Dryer</li>
                        <li><i class="icon-hotel-condition"></i> Air Condition</li>
                        <li><i class="icon-hotel-loundry"></i>Loundry Service</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /bg_white -->

<div class="bg_white add_bottom_120">
    <div class="container-fluid p-lg-0">
        <div data-cues="zoomIn">
            <div class="owl-carousel owl-theme carousel_item_centered kenburns rounded-img">
                @foreach ($images as $image)
                <div class="item">
                    <img src="{{ asset('upload/roomimg/multi_img/'.$image->room_img) }}" alt="">
                </div>
                @endforeach
            </div>
        </div>
        <div class="text-center mt-5">
            @foreach ($images as $key => $image)
            @if ($key == 0)
            <a class="btn_1 outline" data-fslightbox="gallery_1" data-type="image" href="{{ asset('upload/roomimg/multi_img/'.$image->room_img) }}">FullScreen Gallery</a>
            @else
            <a data-fslightbox="gallery_1" data-type="image" href="{{ asset('upload/roomimg/multi_img/'.$image->room_img) }}"></a>
            @endif
            @endforeach
        </div>
    </div>
</div>
<!-- /bg_white -->

<div class="container margin_120_95" id="reviews">
    <div class="row justify-content-between">
        <div class="col-lg-4 order-lg-2 fixed_title reviews_sum_details">
            <div class="title">
                <small>Paradise Hotel</small>
                <h2>Reviews</h2>
            </div>
            <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus.</p>
            <h6>Comfort</h6>
            <div class="row mb-2">
                <div class="col-xl-10 col-lg-9 col-10">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-2"><strong>9.0</strong></div>
            </div>
            <!-- /row -->
            <h6>Facilities</h6>
            <div class="row mb-2">
                <div class="col-xl-10 col-lg-9 col-10">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-2"><strong>9.5</strong></div>
            </div>
            <!-- /row -->
            <h6>Location</h6>
            <div class="row mb-2">
                <div class="col-xl-10 col-lg-9 col-10">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-2"><strong>6.0</strong></div>
            </div>
            <!-- /row -->
            <h6>Price</h6>
            <div class="row mb-2">
                <div class="col-xl-10 col-lg-9 col-10">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-2"><strong>6.0</strong></div>
            </div>
            <!-- /row -->
        </div>
        <div class="col-lg-7 order-lg-1">
            <div class="review_card">
                <div class="row">
                    <div class="col-md-2 user_info">
                        <figure><img src="img/avatar4.jpg" alt=""></figure>
                        <h5>Lukas</h5>
                    </div>
                    <div class="col-md-10 review_content">
                        <div class="clearfix mb-3">
                            <span class="rating">8.5<small>/10</small> <strong>Rating average</strong></span>
                            <em>Published 54 minutes ago</em>
                        </div>
                        <h4>"Great Location!!"</h4>
                        <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.</p>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /review_card -->
            <div class="review_card">
                <div class="row">
                    <div class="col-md-2 user_info">
                        <figure><img src="img/avatar6.jpg" alt=""></figure>
                        <h5>Lukas</h5>
                    </div>
                    <div class="col-md-10 review_content">
                        <div class="clearfix mb-3">
                            <span class="rating">8.5<small>/10</small> <strong>Rating average</strong></span>
                            <em>Published 10 Oct. 2022</em>
                        </div>
                        <h4>"Awesome Experience"</h4>
                        <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.</p>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /review_card -->
            <div class="review_card">
                <div class="row">
                    <div class="col-md-2 user_info">
                        <figure><img src="img/avatar1.jpg" alt=""></figure>
                        <h5>Marika</h5>
                    </div>
                    <div class="col-md-10 review_content">
                        <div class="clearfix mb-3">
                            <span class="rating">9.0<small>/10</small> <strong>Rating average</strong></span>
                            <em>Published 11 Oct. 2022</em>
                        </div>
                        <h4>"Really great dinner!!"</h4>
                        <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.</p>
                    </div>
                </div>
                <!-- /row -->
                <div class="row reply">
                    <div class="col-md-2 user_info">
                        <figure><img src="img/avatar.jpg" alt=""></figure>
                    </div>
                    <div class="col-md-10">
                        <div class="review_content">
                            <strong>Reply from Admin</strong>
                            <em>Published 3 minutes ago</em>
                            <p><br>Hi Monika,<br><br>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.<br><br>Thanks</p>
                        </div>
                    </div>
                </div>
                <!-- /reply -->
            </div>
            <!-- /review_card -->
            <p class="text-end"><a href="#0" class="btn_1">Leave a review</a></p>
        </div>
    </div>
</div>
<!-- /reviews -->

<div class="bg_white">
    <div class="container margin_120_95">
        <div data-cue="slideInUp">
            <div class="title">
                <small>Paradise Hotel</small>
                <h2>Other Rooms</h2>
            </div>
            <div class="row" data-cues="slideInUp" data-delay="800">
                @foreach ($rooms as $room)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <a href="{{ route('room.details', $room->id) }}" class="box_cat_rooms">
                        <figure>
                            <div class="background-image" data-background="url({{ asset('upload/roomimg/'.$room->image) }})"></div>
                            <div class="info">
                                <small>From ${{ $room->price }}/night</small>
                                <h3>{{ $room->roomtype->name }}</h3>
                                <span>Read more</span>
                            </div>
                        </figure>
                    </a>
                </div>
                @endforeach
            </div>
            <!-- /row-->
        </div>
    </div>
</div>
<!-- /bg_white -->

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
                <form method="post" action="{{ route('user_booking_store') }}" id="booking_form" autocomplete="off">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <input type="text" id="total_adult" value="{{ $room->total_adult }}">
                    <input type="text" id="room_price" value="{{ $room->price }}">
                    <input type="text" id="discount_price" value="{{ $room->discount }}">
                    <input type="text" name="check_in" id="check_in" value="">
                    <input type="text" name="check_out" id="check_out" value="">

                    <div class="booking_wrapper">
                        <div class="col-12" id="daterangepicker-embedded-container">
                            <input type="text" id="date_booking" name="date_booking" value="{{ old('dates') ? urldecode(old('dates')) : '' }}">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="custom_select">
                                    <select class="wide number_of_rooms" name="number_of_rooms" id="select_room">
                                        <!-- <option selected>Number of Rooms</option> -->
                                        @for ($i=1; $i <= 5; $i++) <option value="0{{$i}}">0{{$i}}</option>
                                            @endfor
                                    </select>
                                </div>
                                <input type="hidden" name="available_rooms" id="available_rooms">
                                <p class="available_rooms"></p>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="qty-buttons mb-3 version_2">
                                            <input type="button" value="+" class="qtyplus" name="adults_booking">
                                            <input type="text" name="adults_booking" id="number_person" value="{{ old('adults') ? old('adults') : '1' }}" class="qty form-control" placeholder="Adults">
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
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="text-end"><span class="t_subtotal">0</span></td>
                                        </tr>
                                        <tr>
                                            <th>Discount</th>
                                            <td class="text-end"><span class="t_discount">0</span></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td class="text-end"><span class="t_g_total">0</span></td>
                                        </tr>
                                    </tbody>
                                </table>
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
                    <p class="text-end mt-4"><input class="btn_1 outline" type="submit" value="Check Now" id=""></p>
                </form>
            </div>
            <!-- /data cue -->
        </div>
        <!-- /col -->
    </div>
    <!-- /row -->
</div>

<script>
    $(document).ready(function() {
        var picker = $('#date_booking').daterangepicker({
            parentEl: '#daterangepicker-embedded-container',
            autoUpdateInput: true,
            autoApply: true,
            alwaysShowCalendars: true,
            locale: {
                format: 'DD-MM-YYYY',
            }
        });

        picker.on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            getAvailability(check_in, check_out, room_id);
        });

        //   picker.data('daterangepicker').hide = function () {};
        picker.data('daterangepicker').show();

        var check_in = $('#date_booking').data('daterangepicker').startDate.format('DD-MM-YYYY');
        var check_out = $('#date_booking').data('daterangepicker').endDate.format('DD-MM-YYYY');
        var room_id = "{{ $room_id }}";
        if (check_in != '' && check_out != '') {
            getAvailability(check_in, check_out, room_id);
        }

        $('.number_of_rooms').on('change', function() {
            var check_in = $('#date_booking').data('daterangepicker').startDate.format('DD-MM-YYYY');
            var check_out = $('#date_booking').data('daterangepicker').endDate.format('DD-MM-YYYY');
            if (check_in != '' && check_out != '') {
                getAvailability(check_in, check_out, room_id);
            }
        });

        function getAvailability() {
            $('#check_in').val($('#date_booking').data('daterangepicker').startDate.format('DD-MM-YYYY'));
            $('#check_out').val($('#date_booking').data('daterangepicker').endDate.format('DD-MM-YYYY'));
            $.ajax({
                type: 'GET',
                url: '/check_room_availability',
                data: {
                    room_id: room_id,
                    check_in: check_in,
                    check_out: check_out
                },
                success: function(data) {
                    $(".available_rooms").html('Availability : <span class="text-success">' + data['available_rooms'] + ' Rooms</span>');
                    $("#available_rooms").val(data['available_rooms']);
                    price_calculate(data['total_nights']);
                },
                error: function() {
                    console.log('error');
                }
            });
        }

        function price_calculate(total_nights) {
            var room_price = $('#room_price').val();
            var discount_p = $('#discount_price').val();
            var select_room = $('#select_room').val();

            var sub_total = room_price * total_nights * parseInt(select_room);
            var discount_price = (parseInt(discount_p) / 100) * sub_total;

            $('.t_subtotal').text(sub_total);
            $('.t_discount').text(discount_price);
            $('.t_g_total').text(sub_total - discount_price);
        }

        $('#booking_form').on('submit', function() {
            var avg_room = $('#available_rooms').val();
            var select_room = $('#select_room').val();
            console.log(select_room);
            console.log(avg_room);
            if (parseInt(select_room) > avg_room) {
                alert('Sorry, you select maximum number of rooms');
                return false;
            }

            var number_of_person = $('#number_person').val();
            var total_adult = $('#total_adult').val();
            console.log(number_of_person);
            console.log(total_adult);
            if (parseInt(number_of_person) > parseInt(total_adult)) {
                alert('Sorry, you select maximum number of person');
                return false;
            }
        });
    });
</script>
@endsection