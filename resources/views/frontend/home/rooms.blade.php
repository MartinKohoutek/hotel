@php
    $rooms = \App\Models\Room::latest()->limit(4)->get();
@endphp
<div class="title mb-3">
    <small data-cue="slideInUp">Luxury experience</small>
    <h2 data-cue="slideInUp" data-delay="200">Rooms & Suites</h2>
</div>
<div class="row justify-content-center add_bottom_90" data-cues="slideInUp" data-delay="300">
    @foreach ($rooms as $room)
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
        <a href="room-details.html" class="box_cat_rooms">
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
    <p class="text-end"><a href="room-list-1.html" class="btn_1 outline mt-2">View all Rooms</a></p>
</div>