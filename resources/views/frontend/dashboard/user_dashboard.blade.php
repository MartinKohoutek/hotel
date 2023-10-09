@extends('frontend.main_master')
@section('main')
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
                <div class="service-side-bar">
                    <div class="services-bar-widget">
                        <h3 class="title">User Dashboard</h3>
                        <div class="side-bar-categories">
                            <img src="{{ asset('frontend/img/blog/blog-profile1.jpg') }}" class="rounded mx-auto d-block" alt="Image" style="width:100px; height:100px;"> <br><br>
                            <ul>
                                <li>
                                    <a href="#">User Dashboard</a>
                                </li>
                                <li>
                                    <a href="#">User Profile </a>
                                </li>
                                <li>
                                    <a href="#">Change Password</a>
                                </li>
                                <li>
                                    <a href="#">Booking Details </a>
                                </li>
                                <li>
                                    <a href="#">Logout </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
            <div class="col-lg-9">
                <div class="service-article">
                    <section class="checkout-area pb-70">
                        <div class="container">
                            <form>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-details">
                                            <h3 class="title">User Profile </h3>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>First Name <span class="required">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Last Name <span class="required">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <label>Company Name</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input type="email" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone <span class="required">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>User Profile <span class="required">*</span></label>
                                                        <input type="file" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Town / City <span class="required">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-danger">Save Changes </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection