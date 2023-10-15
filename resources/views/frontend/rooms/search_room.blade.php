@extends('frontend.main_master')
@section('main')
<div class="hero small-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('frontend/img/hero_home_1.jpg') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Luxury Hotel Experience</small>
            <h1 class="slide-animated two">Free Rooms & Suites</h1>
        </div>
    </div>
</div>

<div class="container margin_120_95 pb-0" id="first_section">
    @php
        $empty_array = [];
    @endphp
    @foreach ($rooms as $key => $room)
    @php
        $bookings = \App\Models\Booking::withCount('assignRooms')->whereIn('id', $check_date_booking_ids)->where('rooms_id', $room->id)->get()->toArray();
        $total_book_room = array_sum(array_column($bookings, 'assignRooms_count'));
        $avg_room = @$room->room_numbers_count - $total_book_room;
        $adults = NULL;
        
        if (old('adults') !== NULL) {
            $adults = old('adults');
        } elseif (old('adults_booking') !== NULL) {
            $adults = old('adults_booking');
        }
    @endphp
        
    @if ($avg_room > 0 && $adults <= $room->total_adult)
    <div class="row_list_version_1">
        <div class="pinned-image rounded_container pinned-image--medium">
            <div class="pinned-image__container">
                <img src="{{ asset('upload/roomimg/'.$room->image) }}" alt="">
            </div>
        </div>
        <!-- /pinned-image -->
        <div class="row  @if ($key % 2 == 0) justify-content-start @else justify-content-end @endif">
            <div class="col-lg-8">
                <div class="box_item_info @if ($key % 2 != 0) float-lg-end @endif" data-jarallax-element="-30">
                    <small>From ${{ $room->price }}/night</small>
                    <h2>{{ $room->roomtype->name }}</h2>
                    <p>{{ $room->short_description}}</p>
                    <div class="facilities clearfix">
                        <ul>
                            <li>
                                <i class="customicon-double-bed"></i> King Size Bed
                            </li>
                            <li>
                                <i class="customicon-wifi"></i> Free Wifi
                            </li>
                            <li>
                                <i class="customicon-television"></i> 32 Inc TV
                            </li>
                        </ul>
                    </div>
                    <div class="box_item_footer d-flex align-items-center justify-content-between">
                        <a href="#0" class="btn_4 learn-more">
                            <span class="circle">
                                <span class="icon arrow"></span>
                            </span>
                            <span class="button-text">Book Now</span>
                        </a>
                        <a href="{{ route('room.details', $room->id) }}" class="animated_link">
                            <strong>Read more</strong>
                        </a>
                    </div>
                    <!-- /box_item_footer -->
                </div>
                <!-- /box_item_info -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    @else
    <?php
        array_push($empty_array, $room->id)
    ?>
    @endif
    <!-- /row_list_version_1 -->
    @endforeach

    @if (count($rooms) == count($empty_array))
        <p class="text-center text-danger">Sorry, no data found!</p>
    @endif

</div>
@endsection