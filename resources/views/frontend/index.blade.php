@extends('frontend.main_master')
@section('main')
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
<script src="{{ asset('frontend/js/datepicker_search.js') }}"></script>
<script src="{{ asset('frontend/js/datepicker_inline.js') }}"></script>
@include('frontend.home.booking_one')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="pattern_2">
    @include('frontend.home.about_us')
    @include('frontend.home.video')
</div>

<div class="container margin_120_95">
    @include('frontend.home.rooms')
    @include('frontend.home.facilities')
</div>

<div class="marquee">
    <div class="track">
        <div class="content">&nbsp;Relax Enjoy Luxury Holiday Travel Discover Experience Relax Enjoy Luxury Holiday Travel Discover Experience Relax Enjoy Luxury Holiday Travel Discover Experience Relax Enjoy Luxury Holiday Travel Discover Experience</div>
    </div>
</div>
<!-- /marquee-->

@include('frontend.home.amenities')

@include('frontend.home.testimonials')

@include('frontend.home.news')

@include('frontend.home.booking_two')

@endsection