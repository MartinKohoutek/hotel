@extends('frontend.main_master')
@section('main')
<style>
    .card {
        --bs-card-border-width: 0;
    }
</style>
<div class="hero small-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('frontend/img/hero_home_1.jpg') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Luxury Hotel Experience</small>
            <h1 class="slide-animated two">About Paradise</h1>
        </div>
    </div>
</div>
<div class="service-details-area pt-100 pb-70 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('frontend.dashboard.user_sidebar')
            </div>
            <div class="col-lg-9">
                <div class="service-article">
                    <div class="service-article-title">
                        <h2>User Dashboard </h2>
                    </div>
                    <div class="service-article-content">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Total Booking</div>
                                    <div class="card-body">
                                        <h1 class="card-title" style="font-size: 45px;">3 Total</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Pending Booking </div>
                                    <div class="card-body">
                                        <h1 class="card-title" style="font-size: 45px;">3 Pending</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Complete Booking</div>
                                    <div class="card-body">
                                        <h1 class="card-title" style="font-size: 45px;">3 Complet</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection