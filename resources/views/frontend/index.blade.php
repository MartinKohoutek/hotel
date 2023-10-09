@extends('frontend.main_master')
@section('main')

@include('frontend.home.booking_one')

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